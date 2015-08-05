<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
Route::post('foo/bar', function(){});
Route::get('foo/bar', function(){});
Route::put('foo/bar', function(){});
Route::delete('foo/bar', function(){});
*/

Route::get('/', function () {
    return view('welcome');
});

	Route::group(['middleware' => 'auth'], function(){
		Route::group(['prefix' => 'api'], function(){
	    Route::get('/', function() {  return Auth::user(); });
	    Route::resource('points', 'PointController',
	    	array('only' => array('index', 'show', 'store')));
	    Route::resource('categories', 'CategoryController',
	                array('only' => array('index', 'store', 'show')));
		});
	});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
