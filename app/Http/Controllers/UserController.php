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
      $my_user_id = Auth::user()->id;
      $user = User::with('role')->where('id', $my_user_id)->get();
      if (!$user){
        return $this->respondUnauthorized();
      }

      return $user;
    }
}
