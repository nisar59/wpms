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

Route::group(['prefix'=>'country','middleware' => ['permission:country.view']],function(){
	Route::get('/', 'CountryController@index');
});

Route::group(['prefix'=>'country','middleware' => ['permission:country.add']],function(){
	Route::get('/create', 'CountryController@create');
	Route::POST('/store', 'CountryController@store');

});
Route::group(['prefix'=>'country','middleware' => ['permission:country.edit']],function(){
	Route::get('/edit/{id}', 'CountryController@edit');
	Route::POST('/update/{id}', 'CountryController@update');


});
Route::group(['prefix'=>'country','middleware' => ['permission:country.delete']],function(){
	Route::get('/destroy/{id}', 'CountryController@destroy');
});