<?php namespace App\Http\Controllers;

use Fractal;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Validation\Validator;
use Illuminate\Http\Response;
use App\Http\Requests\CreatePointRequest;
use App\Http\Controllers\Controller;
use App\Point;


class PointController extends ApiController
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
            $points = Point::with('user')->with('category')->get();
            if (!$points) {
                return $this->respondNotFound();
            }

            return Fractal::collection($points, new \App\Transformers\PointTransformer)->responseJson(200);

        } 
        catch (Exception $e) 
        {
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

        try {
            $point = Point::where('id', $id)->with('user')->with('category')->with('image')->first();

            if (!$point) {
                return $this->respondNotFound();
            }


            return Fractal::item($point, new \App\Transformers\PointTransformer)->responseJson(200);

        } catch (Exception $e) {
            return $this->respondInternalError();
        }


    }


    
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Requests\CreatePointRequest $request)
    {


        try {

            // Bind input to data array
            $data = [
                'longitude' => \Input::get('longitude'),
                'latitude' => \Input::get('latitude'),
                'created_by' => \Auth::user()->id,
                'image'     => \Input::get('image'),
                'category_id'     => \Input::get('category'),
            ];

            // Validate

            return $data;



            // Add to DB

            // Success or Error


        } catch (Exception $e) {
            return $this->_fail_505();
        }
        
    }




    

    
    


}
