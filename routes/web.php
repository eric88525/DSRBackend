<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

#直接導引到前端
Route::get('/public', function () {
    //return View::make('index');
    return redirect('你的前端網址');
});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

