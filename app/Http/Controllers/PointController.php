<?php

namespace App\Http\Controllers;

use App\Point;
use Fractal;
use App\Transformers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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

        \DB::enableQueryLog();




          /*$resp = \DB::table('points')
            ->join('point_tags', 'points.id', '=', 'point_tags.point_id')
            ->join('tags', 'tags.id', '=', 'point_tags.tag_id')
            ->select('points.*', 'tags.name as tag', 'point_tags.*')
            ->get();*/

            $resp = Point::with('tags')->with('user')->with('image')->get();

            //dd($resp);

          if (!$resp) {
              return $this->respondNotFound();
          }
          return Fractal::collection($resp, new \App\Transformers\PointTransformer)->responseJson(200);
      }
      catch (Exception $e)
      {
          return $this->respondWithError();
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
        $resp = Point::find($id);

          if (!$resp) {
              return $this->respondNotFound();
          }
          return Fractal::item($resp, new \App\Transformers\PointTransformer)->responseJson(200);
      }
      catch (Exception $e)
      {
          return $this->respondWithError();
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
}
