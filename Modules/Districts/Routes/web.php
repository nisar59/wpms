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
Route::group(['prefix'=>'districts','middleware' => ['permission:districts.view']],function(){
	Route::get('/', 'DistrictsController@index');
});

Route::group(['prefix'=>'districts','middleware' => ['permission:districts.add']],function(){
	Route::get('/create', 'DistrictsController@create');
	Route::POST('/store', 'DistrictsController@store');
	Route::POST('/fetch-states', 'DistrictsController@fetchState');
});
Route::group(['prefix'=>'districts','middleware' => ['permission:districts.edit']],function(){
	Route::get('/edit/{id}', 'DistrictsController@edit');
	Route::POST('/update/{id}', 'DistrictsController@update');


});
Route::group(['prefix'=>'districts','middleware' => ['permission:districts.delete']],function(){
	Route::get('/destroy/{id}', 'DistrictsController@destroy');
});

