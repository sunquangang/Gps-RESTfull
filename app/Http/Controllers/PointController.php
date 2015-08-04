<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Validation\Validator;
use Illuminate\Http\Response;
use App\Http\Requests\CreatePointRequest;
use App\Http\Controllers\Controller;
use App\Point;
use Arelstone\Transformers\PointTransformer;


class PointController extends ApiController
{
    /**
     * @var Arelstone/Transformer/PointTransformer
     */
    protected $transformer;

    /**
     * PointController constructor.
     * @param Arelstone $pointTransformer
     */
    public function __construct(PointTransformer $pointTransformer)
    {

        $this->transformer = $pointTransformer;


    }

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
            if ($points) {
                //return $points;
                return \Response::json([
                    'data' => $this->transform()->transformCollection($points)
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        try {
            $point = Point::where('id', $id)->with('user')->with('category')->first();

            if (!$point) {
                return $this->respondNotFound();
            }
            return $this->respond([
                'data' => $this->transformer->transform($point)
            ]);

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




    

    
    


}
