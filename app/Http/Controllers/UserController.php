<?php

namespace App\Http\Controllers;

use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Mockery\CountValidator\Exception;

class UserController extends ApiController
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function myAuthData()
    {
      //var_dump(Auth::user());
      $user = User::find(Auth::user()->id)->with('role')->firstOrFail();
      //dump($user->role->name);
      if (!$user){
        return $this->respondUnauthorized();
      }
      return $user;
    }
    
    public function show($id){
        try {
            $user = User::find($id)->with('role')->firstOrFail();
            if ($user) {
                return Fractal::item($user, new \App\Transformers\UserTransformer)->responseJson(200);
            } else {
                return $this->respondNotFound();
            }
        } catch (Exception $e) {
            return $e;
        }



    }
}
