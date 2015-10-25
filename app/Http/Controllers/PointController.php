<?php namespace App\Http\Controllers;

/**
 * Point Controller
 *
 * @package  Point
 * @copyright  Carsten Daurehøj <arelstone@gmail.com>
 * @author  Carsten Daurehøj <arelstone@gmail.com>
 * */

use App\Point;
use App\PointTag;
use App\Transformers\PointTransformer;
use Fractal;
use Illuminate\Http\Request;
use App\Http\Requests\StorePointsRequest;
use Mockery\CountValidator\Exception;

/**
 * Class PointController
 * @package App\Http\Controllers
 */
class PointController extends ApiController
{
  public $user;


  public function update($id)
{
    $point = Point::find($id);
    $me = \Auth::user();
//var_dump($this->user->role->name);
    if (!$point->created_by == $me->id || !$this->user->role->name == "admin") {
        return $this->respondRestricted('You did not create this point or you do not have the right role!');
    }
    $point->name = \Input::get('name', $point->name);
    $point->description = \Input::get('description', $point->description);
    $point->latitude = \Input::get('longitude', $point->longitude);
    $point->longitude = \Input::get('latitude', $point->latitude);
    $point->country = \Input::get('country', $point->country);
    $point->updated_at = date('Y-m-d H:i:s');
    $point->updated_by = \Auth::user()->id;

    if (!$point->save()){
      return $this->respondInternalError('Could not save point!');
    }
    //dump($point);
    return Fractal::item($point, new PointTransformer())->responseJson(200);
  }

    protected $defaultLimit = 10;
    protected $limit;
    protected $popular = false;



   	//dump($user->role->name);
   	/*if (!$user){
   		return $this->respondUnauthorized();
   	}
   	return $user;*/
   	public function setUser()
   	{
      if (!\Auth::user()) {
        return false;
      }
   		$user = \App\User::find(\Auth::user()->id)->with('role')->firstOrFail();
   		return $this->user = $user;
   	}


    public function __construct(Request $request)
    {
      $this->setUser();
        if (!$request->get('limit')) {
            $this->setLimit($this->defaultLimit);
        } else {
            $this->setLimit($request->get('limit'));
        }
        if ($request->get('popular') == 'true') {
            $this->setPopular(true);
        }


    }

    /**
     * Display a listing of the resource.
     * @param INT $limit Default is set to 15, You may with to overwide this.
     * @return Response
     */
    public function index(Request $request)
    {
        try {
            if ($this->getPopular()){
                $resp = $this->popular();
            } else {
                $resp = Point::paginate($request->limit);
            }
            if (!$resp) {
                return $this->respondNotFound();
            }
            return Fractal::collection($resp, new PointTransformer())->responseJson(200);
        } catch (Exception $e) {
            return $this->respondWithError();
        }
    }

    public function popular(){
        $points = \App\PointHitsView::with('point')->paginate($this->getLimit());
        return $points;
    }

    /**
     * Store a newly created resource in storage.
     *  !NOTE! That Tags should be a comma seperated list of tag_id's
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'name' => 'required|min:3',
                'description' => 'required|min:3',
                'latitude' => 'required|min:3',
                'longitude' => 'required|min:3',
                'tags' => 'required',
                'country' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->respondWithError($validator->errors());
            }

            /** @param tags !NOTE! Tags should be a comma seperated list of tag id's */
            $tags = explode(',', $request->get('tags'));

            $stdObj = new Point();
            $stdObj->name = $request->get('name');
            $stdObj->description = $request->get('description');
            $stdObj->longitude = $request->get('longitude');
            $stdObj->latitude = $request->get('latitude');
            $stdObj->country = $request->get('country');
            $stdObj->created_by = \Auth::user()->id;
            $stdObj->updated_by = \Auth::user()->id;
            if (!$stdObj->save()) {
                return $this->respondWithError();
            }
            foreach ($tags as $t) {
                $tag = new PointTag();
                $tag->point_id = $stdObj->id;
                $tag->created_by = \Auth::user()->id;
                $tag->tags_id = $t;
                if (!$tag->save()) {
                    return $this->respondWithError('Could not add tag (' . $t . ')');
                }
            }
            return Fractal::item($stdObj, new PointTransformer())->responseJson(200);
        } catch (Exception $e) {
            return $this->respondInternalError();
        }
    }


    /**
     * Display the specified resource.
     * @param int $id
     * @return Response
     * @see GET -> api/points/{id}
     */
    public function show($id)
    {
        try {
            $resp = Point::find($id);
            if (!$resp) {
                return $this->respondNotFound();
            }
            $this->update_point_hits_table($id);

            return Fractal::item($resp, new PointTransformer())->responseJson(200);
        } catch (Exception $e) {
            return $this->respondWithError();
        }
    }

    /**
     * @return mixed
     */
    public function getPopular()
    {
        return $this->popular;
    }

    /**
     * @param mixed $popular
     */
    public function setPopular($popular)
    {
        $this->popular = $popular;
    }


    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param mixed $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }


    public function update_point_hits_table($point_id)
    {
        try {
            $hit = new \App\PointHit();
            $hit->point_id = $point_id;
            if (!$hit->save()) {
                return $this->respondInternalError();
            }
            return $hit;

        } catch (Exception $e) {
            return $this->respondWithError();
        }
    }

}
