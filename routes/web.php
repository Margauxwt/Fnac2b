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
Route::get('/visitorSearch', function () {
    return view('visitorSearch');
});
Route::get('/visitorResultSearch', function () {
    if(isset($_GET["realisator"]) && isset($_GET["lastname"]))
    {
        if(!empty($_GET["realisator"]) && !empty($_GET["lastname"]))
        {
            return view('visitorResultSearch');
        }
        else
        {
            return view('visitorSearch');
        }
    } 
    return view('visitorResultSearch');
});
Route::get('/register',function(){
    return view('register');
});

Route::get('/profil', 'UserController@chargerInfos')->route("/profil");

Route::get('/modifyaccount', 'modifyController@begin');

Route::post('/modifyaccount', 'modifyController@update');