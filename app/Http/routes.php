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


Route::get('/', function () {
    return View::make('welcome');
});

Route::group(['middleware' => 'cors'], function () {
    Route::group(['prefix' => 'api'], function () {

        Route::get('/', 'UserController@myAuthData');
        Route::get('upload/{filename}', 'ImageController@show');
        Route::get('points/popular', 'PointController@popular');
        Route::get('points', 'PointController@index');
        Route::get('points/{id}', 'PointController@show');
        Route::get('tags', 'TagController@index');
        Route::get('tags/{id}', 'TagController@show');
        Route::get('points/{id}/like', 'PointLikeController@show');
        Route::get('points/likes', 'PointLikeController@all');

        Route::get('users/{id}', 'UserController@show');

        Route::group(['middleware' => 'auth.basic'], function () {
            Route::post('points', 'PointController@store');
            Route::put('points/{id}', 'PointController@update');
            Route::post('points/{id}/like', 'PointLikeController@store');
            Route::delete('points/{id}/like', 'PointLikeController@destroy');
            Route::post('points/{id}/upload', 'ImageController@store_base64');
            Route::post('tags', 'TagController@store');
        });

    });
});


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
