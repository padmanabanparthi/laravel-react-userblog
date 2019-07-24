<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/users','Api\UserController');
// Route::post('/users','Api\UserController@store');
// Route::get('/profile/edit', 'Api\UserController@edit');
// Route::post('/profile/update', 'Api\UserController@update');

Route::get('/posts','PostController@all_post_for_api');
Route::get('/post/{id}','PostController@single_post_for_api');