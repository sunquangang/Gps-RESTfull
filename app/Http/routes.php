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


Route::group(['middleware' => 'auth'], function(){
  Route::get('/', 'PointController@index');

	Route::group(['middleware' => 'cors'], function(){
		Route::group(['prefix' => 'api'], function(){
			Route::resource('points', 'PointController',
				array('only' => array('index', 'show', 'store')));
			Route::resource('tags', 'TagController',
				array('only' => array('index', 'store', 'show')));
			//Route::get('categories/{id}/points', 'CategoryController@showWithPoint');
		});

	});

});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
