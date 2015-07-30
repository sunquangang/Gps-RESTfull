<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Point;
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
            $points = Point::with('user')->get();
            if ($points) {
                return \Response::json([
                    'data' => $this->transformCollection($points)
                ], 200);
            } else {
                return \Response::json([
                    'error' => 'Collection not found', 
                    'status' => 404
                ], 404);
            }
        } 
        catch (Exception $e) 
        {
            return \Response::json([
                'error' => 'Something did not work as expected.',
                'status' => '501',
            ], 501);
        }
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
            $points = Point::where('id', $id)->with('user')->with('image')->first();
            if ($points) {
                return \Response::json([
                    'data' => $this->transformItem($points->toArray())
                ], 200);
            } else {
                return \Response::json([
                    'error' => 'Collection not found', 
                    'status' => 404
                ], 404);
            }
        } 
        catch (Exception $e) 
        {
            return \Response::json([
                'error' => 'Something did not work as expected.',
                'status' => '501',
            ], 501);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


    private function transformCollection(array $points)
    {
        return array_map([$this, 'transformItem'], $points->toArray());
    }

    private function transformItem($point){
        return [
            'id' => (int) $point['id'],
            'coordinates' => [
                'longitude' => $point['longitude'],
                'latitude' => $point['latitude']
            ],
            'images' => [ 
                'path' => $point['image']
            ],
            'created_at' => Date($point['created_at']),
            'created_by' => $point['user'],
            'links'   => [
                'rel' => 'self',
                'uri' => '/api/point/'.$point['id'],
            ]
        ];
    }


}
