<?php namespace App\Http\Controllers;

use App\Transformers\PointTransformer;
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

            return Fractal::collection($points, new PointTransformer)->responseJson(200);

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


            return Fractal::item($point, new PointTransformer)->responseJson(200);

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
    public  function store(Request $request){


        try {
            //return $request->name;

            $validator = \Validator::make($request->all(), [
                'longitude' => 'required|min:3|',
                'latitude' => 'required|min:3',
                'category' => 'required',
            ]);


            if ($validator->fails()) {
                return $this->respondWithError($validator->errors());
            }

            $model = new Point;
            $model->coordinates = $request->longitude . ',' . $request->latitude;
            $model->longitude = $request->longitude;
            $model->latitude = $request->latitude;
            $model->created_by = \Auth::user()->id;
            $model->category_id = $request->category;



            if (!$model->save()){
                return $this->respondWithError('Could not create point');
            }
            return Fractal::item($model, new PointTransformer)->responseJson(200);


            //return redirect('/categories');


        } catch(Exception $e) {
            return $this->respondInternalError();
        }


    }




    

    
    


}
