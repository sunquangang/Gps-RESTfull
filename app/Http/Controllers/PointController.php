<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Http\Response;
use App\Http\Requests\CreatePointRequest;
use App\Http\Controllers\Controller;
use App\Point;
use Input;
class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try
        {
            $points = Point::with('user')->with('image')->with('category')->get();
            if ($points) {
                //return $points;
                return \Response::json([
                    'data' => $this->transformCollection($points)
                ], 200);
            } else {
                return $this->_fail_404();
            }
        } 
        catch (Exception $e) 
        {
            return $this->_fail_505();
        }
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreatePointRequest $request)
    {
        try {

            // Bind input to data array
            $data = [
                'longitude' => Input::get('longitude'),
                'latitude' => Input::get('latitude'),
                'created_by' => \Auth::user()->id,
                'image'     => Input::get('image'),
                'category_id'     => Input::get('category'),
            ];

            // Validate

            return $this->validate($request, [
                'longitude' => 'required',
                'latitude' => 'required',
                'created_by' => 'category_id',
            ]);



            // Add to DB

            // Success or Error


        } catch (Exception $e) {
            return $this->_fail_505();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        try
        {
            $point = Point::where('id', $id)->with('user')->with('image')->with('category')->first();
            $point = $point;
            if ($point) {
                return \Response::json([
                    'data' => $this->transformItem($point->toArray())
                ], 200);
                //return $this->fractal->item($point, new PointTransformer()); 
            } else {
                return $this->_fail_505();
            }
        } 
        catch (Exception $e) 
        {
            return $this->_fail_505();
        }
    }


    private function transformCollection($points)
    {
        $points = $points->toArray();
        //$points['count'] = count($points);
        return array_map([$this, 'transformItem'], $points);
    }

    /**
     * Display a listing of the resource.
     * @method private
     * @return Response
     */
    private function transformItem(array $point){
//return $point['category'];
        return [
            'id' => (int) $point['id'],
            'coordinates' => [
                'longitude' => $point['longitude'],
                'latitude' => $point['latitude']
            ],
            'category' => $point['category'],
            'image' => $point['image'],
            'created_by' => $point['user'],
            'meta' => [
                'created_at' => Date($point['created_at']),
                'last_update' => Date($point['updated_at']),
                'links'   => [
                    'rel' => 'self',
                    'uri' => '/api/points/'.$point['id'],
                ],
            ]
        ];
    }
    private function _fail_404(){
        return \Response::json([
                    'error' => 'Collection not found', 
                    'status' => 404
            ], 404);
    }
    private function _fail_505() {
        return \Response::json([
                'error' => 'Something did not work as expected.',
                'status' => '501',
            ], 501);
    }


}
