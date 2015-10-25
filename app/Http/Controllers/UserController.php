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
      //var_dump(Auth::user());
      $user = User::find(Auth::user()->id)->with('role')->firstOrFail();
      //dump($user->role->name);
      if (!$user){
        return $this->respondUnauthorized();
      }
      return $user;
    }
}
