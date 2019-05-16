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

Route::get('/', function () {
    return view('welcome');
});

//
Route::get('/test/testCurl','Test\apiTestController@testCurl');

Route::get('/test/curlPost','Test\apiTestController@curlPost');
Route::get('/test/curlData','Test\apiTestController@curlData');
Route::get('/test/curlRaw','Test\apiTestController@curlRaw');

//
Route::get('/user/index','User\LoginController@index');
Route::post('/user/login','User\LoginController@login');

//
Route::post('/demo/reg/','Test\DemoController@reg');
Route::post('/demo/login/','Test\DemoController@login');
Route::post('/demo/center/','Test\DemoControlelr@center');