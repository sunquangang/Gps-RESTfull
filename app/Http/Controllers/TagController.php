<?php

namespace App\Http\Controllers;

use App\Tags;
use Fractal;
use App\Transformers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TagController extends ApiController
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
             $resp = Tags::all();
             if (!$resp) {
                 return $this->respondNotFound();
             }
             return Fractal::collection($resp, new \App\Transformers\TagTransformer)->responseJson(200);
         }
         catch (Exception $e)
         {
             return $this->respondWithError();
         }
     }


     /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
      try {
          //return $request->name;
          $validator = \Validator::make($request->all(), [
              'name' => 'required|unique:tags|min:3'
          ]);
          if ($validator->fails()) {
              return $this->respondWithError($validator->errors());
          }

          $stdObj = new Tags;
          $stdObj->name = $request->get('name');
          $stdObj->created_by = \Auth::user();
          dd($stdObj);
          if (!$stdObj->save()){
              return $this->respondWithError();
          }
          return Fractal::item($stdObj, new \App\Transformers\TagTransformer)->responseJson(200);
      } catch(Exception $e) {
          return $this->respondInternalError();
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
          $resp = Tags::find($id);
          if (!$resp) {
              return $this->respondNotFound();
          }
          /*foreach ($resp->points as $point) {
            var_dump($point);
          }*/
          return Fractal::item($resp, new \App\Transformers\TagTransformer)->responseJson(200);
      }
      catch (Exception $e)
      {
          return $this->respondWithError();
      }
    }
}
