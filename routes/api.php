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


Route::group(['prefix'=>'Auth'],function () {
    Route::post('login', 'MemberAuth@login');

});
Route::group(['prefix'=>'Auth','middleware'=>'admin'],function () {
    Route::post('register', 'MemberAuth@register');
});

Route::group(['prefix'=>'Auth','middleware'=>'data'],function () {
    Route::get('me','MemberAuth@me');
    Route::get('logout','MemberAuth@logout');
});


Route::group(['middleware'=>'data'],function () {
    Route::post('search','ProjectController@search');
    Route::get('projects','ProjectController@list');
    Route::get('projects/{opportunity}', 'ProjectController@detail');
});

