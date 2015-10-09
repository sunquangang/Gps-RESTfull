<?php namespace App\Http\Controllers;
/**
 * Point Controller
 *
 *
 * @package  Point
 * @copyright  Carsten Daurehøj <arelstone@gmail.com>
 * @author  Carsten Daurehøj <arelstone@gmail.com>
 * */

use App\Point;
use Fractal;
use Illuminate\Http\Request;
class PointController extends ApiController
{
    /**
     * Display a listing of the resource.
     * @param $limit int Default is set to 15, You may with to overwide this.
     * @return Response
     * @see GET -> api/points
     */
    public function index($limit = 15)
    {
        try {
            $resp = Point::paginate($limit);
            if (!$resp) {
                return $this->respondNotFound();
            }
            return Fractal::collection($resp, new \App\Transformers\PointTransformer())->responseJson(200);
        } catch (Exception $e) {
            return $this->respondWithError();
        }
    }

     /**
      * Store a newly created resource in storage.
      *  !NOTE! That Tags should be a comma seperated list of tag_id's
      * @param  Request  $request
      * @return Response
      * @see POST -> api/points
      */
     public function store(Request $request)
     {
         try {
           $validator = \Validator::make($request->all(), [
               'name' => 'required|min:3',
               'description' => 'required|min:3',
               'latitude' => 'required|min:3',
               'longitude' => 'required|min:3',
               'tags' => 'required'
           ]);
             if ($validator->fails()) {
                 return $this->respondWithError($validator->errors());
             }

            /** @param tags NOTE! Tags should be a comma seperated list of tag id's */
             $tags = explode(',', $request->get('tags'));

             $stdObj = new Point();
             $stdObj->name = $request->get('name');
             $stdObj->description = $request->get('description');
             $stdObj->longitude = $request->get('longitude');
             $stdObj->latitude = $request->get('latitude');
             $stdObj->created_by = \Auth::user()->id;
             $stdObj->updated_by = \Auth::user()->id;
             if (!$stdObj->save()) {
                 return $this->respondWithError();
             }
             foreach ($tags as $t) {
                 $tag = new \App\PointTag();
                 $tag->point_id = $stdObj->id;

                 $tag->tags_id = $t;
                 if (!$tag->save()) {
                     return $this->respondWithError('Could not add tag ('.$t.')');
                 }
             }
             return Fractal::item($stdObj, new \App\Transformers\PointTransformer())->responseJson(200);
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

            return Fractal::item($resp, new \App\Transformers\PointTransformer())->responseJson(200);
        } catch (Exception $e) {
            return $this->respondWithError();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @todo
     * @param int $id
     * @return Response
     * @todo
     */
    public function edit($id)
    {
        //
        return false;
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int     $id
     * @return Response
     * @todo
     */
    public function update(Request $request, $id)
    {
        //
        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     * @todo
     */
    public function destroy($id)
    {
        //
        //
        return false;
    }
}
