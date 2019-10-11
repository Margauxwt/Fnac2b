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
Route::get('/logout', 'UserController@logout');
Route::get('/register',function(){
    return view('register'); //Créer un compte
});
Route::get('/registerOther',function(){
    return view('registerOther'); //Créer un compte autre que acheteur
});
Route::get('/login',function(){
    return view('login'); //Se connecter
});
Route::post('/login', 'UserController@login');


Route::post('/registerOther', 'UserController@create', ['data' => $_POST]);

Route::get('/visitorSearch', 'videoController@all');
Route::get('/videoComparator', 'videoController@allComparator');
Route::post('/videoComparator', 'videoController@comparator');

Route::post('/register', 'BuyerController@add_user');

Route::get('/profil', 'BuyerController@index'); //Charge les informations profils avec index() quand on va sur son profil

Route::get('/modifyaccount', 'BuyerController@indexAccountModify');
Route::post('/modifyaccount', 'BuyerController@update');

Route::get('/rankingVideo', 'videoController@allRank');


Route::get('/consultationVideo', 'videoController@detail'); //Consultation des avis et de la vidéo
Route::post('/consultationVideo', 'videoController@detail');