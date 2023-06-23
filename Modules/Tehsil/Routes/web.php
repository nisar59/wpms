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

Route::group(['prefix'=>'tehsil','middleware' => ['permission:tehsil.view']],function(){
	Route::get('/', 'TehsilController@index');
});

Route::group(['prefix'=>'tehsil','middleware' => ['permission:tehsil.add']],function(){
	Route::get('/create', 'TehsilController@create');
	Route::POST('/store', 'TehsilController@store');
	Route::POST('/fetch-states', 'TehsilController@fetchState');
	Route::POST('/fetch-cities', 'TehsilController@fetchCity');


});
Route::group(['prefix'=>'tehsil','middleware' => ['permission:tehsil.edit']],function(){
	Route::get('/edit/{id}', 'TehsilController@edit');
	Route::POST('/update/{id}', 'TehsilController@update');


});
Route::group(['prefix'=>'tehsil','middleware' => ['permission:tehsil.delete']],function(){
	Route::get('/destroy/{id}', 'TehsilController@destroy');
});
