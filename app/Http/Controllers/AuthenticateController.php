<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;

class AuthenticateController extends Controller
{

    public function __construct()
   {
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
       $this->middleware('jwt.auth', ['except' => ['authenticate', 'index']]);
   }


  public function index(){
  $users = \App\Point::all();

  return \Response::json($users);
  }

  public function authenticate(Request $request)
    {
    try {
      $credentials = \Request::only('email', 'password');
      if (! $token = \JWTAuth::attempt($credentials)) {
                return \Response::json(['error' => 'invalid_credentials'], 401);
      }
      return \Response::json(compact('token'));
    } catch (JWTException $e) {
      return \Response::json(['error' => 'could_not_create_token'], 500);
    }
  }

}
