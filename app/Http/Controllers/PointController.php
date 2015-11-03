<?php

namespace App\Http\Controllers;

/*
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
use Auth;
use Input;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;

/**
 * Class PointController.
 */
class PointController extends ApiController
{
    public $user;
    protected $limit = 30;
    protected $popular = false;

    /**
     * The constructor.
     *
     * @param Request $request Laravel Request object
     */
    public function __construct(Request $request)
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @param INT $limit Default is set to 15, You may with to overwide this.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        try {
            $resp = Point::paginate($this->limit);


            if (!$resp) {
                return $this->respondNotFound();
            }

            return Fractal::collection($resp, new PointTransformer())->responseJson(200);
        } catch (Exception $e) {
            return $this->respondWithError();
        }
    }

    /**
     * Get points by Popularity.
     *
     * @return mixed
     */
    public function popular()
    {
        try {
            $resp = \App\PointHitsView::with('point')->paginate($this->limit);
            if (!$resp) {
                return $this->respondNotFound();
            }

            return Fractal::collection($resp, new PointTransformer())->responseJson(200);
        } catch (Exception $e) {
            return $this->respondWithError();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @NOTE That Tags should be a comma seperated list of tag_id's.
     *
     * @param Request $request
     *
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
            $point = new Point();
            $point->name = $request->get('name');
            $point->description = $request->get('description');
            $point->longitude = $request->get('longitude');
            $point->latitude = $request->get('latitude');
            $point->country = $request->get('country');
            $point->created_by = Auth::user()->id;
            $point->updated_by = Auth::user()->id;
            if (!$point->save()) {
                return $this->respondWithError();
            }
            /* @param tags !NOTE! Tags should be a comma seperated list of tag id's */
            $tags = explode(',', $request->get('tags'));
            foreach ($tags as $t) {
                $tag = new PointTag();
                $tag->point_id = $point->id;
                $tag->created_by = Auth::user()->id;
                $tag->tags_id = $t;
                if (!$tag->save()) {
                    return $this->respondWithError('Could not add tag ('.$t.')');
                }
            }

            return Fractal::item($point, new PointTransformer())->responseJson(200);
        } catch (Exception $e) {
            return $this->respondInternalError();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $resp = Point::find($id);
            if (!$resp) {
                return $this->respondNotFound();
            }

            $resp->likes = count($resp->likes);
            
            $this->update_point_hits_table($id);

            return Fractal::item($resp, new PointTransformer())->responseJson(200);
        } catch (Exception $e) {
            return $this->respondWithError();
        }
    }

    /**
     * Update the values of a point.
     *
     * @param int $id The id of the point
     *
     * @return mixed JSON object with the point data
     */
    public function update($id)
    {
        try {
            $point = Point::find($id);
            if (!$point->created_by == $this->user || !$this->user->role->name == 'admin') {
                return $this->respondRestricted('You did not create this point or you do not have the right role!');
            }
            $point->name = Input::get('name', $point->name);
            $point->description = Input::get('description', $point->description);
            $point->latitude = Input::get('longitude', $point->longitude);
            $point->longitude = Input::get('latitude', $point->latitude);
            $point->country = Input::get('country', $point->country);
            $point->updated_at = date('Y-m-d H:i:s');
            $point->updated_by = Auth::user()->id;
            if (!$point->save()) {
                return $this->respondInternalError('Could not save point!');
            }

            return Fractal::item($point, new PointTransformer())->responseJson(200);
        } catch (Exception $e) {
            return $this->respondWithError();
        }
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
