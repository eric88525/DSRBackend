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





Route::post('login', 'Api\AuthController@login');

Route::group(['prefix'=>'Auth'],function () {
    Route::post('register', 'MemberAuth@register');
    Route::post('login', 'MemberAuth@login');
    Route::get('me','MemberAuth@me');
    Route::get('logout','MemberAuth@logout');
});

Route::post('search','Projects@search');


Route::get('projects','Projects@list');
