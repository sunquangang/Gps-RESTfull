<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

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
        if (!Auth::user()){
            return $this->respondUnauthorized();
        }

      $user = User::find(Auth::user()->id)->with('role')->firstOrFail();
      if (!$user){
        return $this->respondUnauthorized();
      }
      return $user;
    }
}
