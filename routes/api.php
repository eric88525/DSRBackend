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
    Route::post('register', 'MemberAuth@register');
});


Route::group(['prefix'=>'Auth','middleware'=>'data'],function () {
    Route::get('me','MemberAuth@me');
    Route::get('logout','MemberAuth@logout');
});


Route::group(['middleware'=>'data'],function () {
    Route::post('search','Projects@search');
    Route::get('projects','Projects@list');
});

