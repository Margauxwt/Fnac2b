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

Route::get('/visitorSearch', 'videoController@all');

Route::get('/register',function(){
    return view('register');
});
Route::post('/register', 'UserController@add_user');

Route::get('/profil', 'UserController@index');

Route::get('/modifyaccount', 'UserController@indexAccountModify');
Route::post('/modifyaccount', 'UserController@update');
