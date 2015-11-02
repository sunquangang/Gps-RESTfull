<?php

namespace App\Http\Controllers;

use App\PointLike;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Transformers\PointLikeTransformer;

class PointLikeController extends ApiController
{


  public function all()
  {
    $likes = \DB::table('point_likes_view')->select('*')->get();
    return \Fractal::collection($likes, new PointLikeTransformer())->responseJson(200);
  }

  public function show(Request $request)
  {
    $likes = \DB::table('point_likes_view')->select('*')->where('point_id', $request->id)->first();
    return \Fractal::item($likes, new PointLikeTransformer())->responseJson(200);
    
  }

    /**
     * Like a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = [
        'point_id' => $request->id,
        'user_id' => $this->user->id
      ];

      $like = \App\PointLike::firstOrCreate($data);

      return $like;
    }


    public function destroy($id)
    {
      //dump($id);
      $delete = \App\PointLike::where('point_id', $id)->where('user_id', $this->user->id)->delete();
      if ($delete) {
      return \Response::json(['Deleted succesfully']);
    } else {
      return \Response::json(['Entry do not exist!']);
    }
    }

}
