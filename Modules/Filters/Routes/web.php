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

Route::group(['prefix'=>'filters','middleware' => ['permission:filters.view']],function(){
	Route::get('/', 'FiltersController@index');
});

Route::group(['prefix'=>'filters','middleware' => ['permission:filters.add']],function(){
	Route::get('/create', 'FiltersController@create');
	Route::POST('/store', 'FiltersController@store');

});
Route::group(['prefix'=>'filters','middleware' => ['permission:filters.edit']],function(){
	Route::get('/edit/{id}', 'FiltersController@edit');
	Route::POST('/update/{id}', 'FiltersController@update');


});
Route::group(['prefix'=>'filters','middleware' => ['permission:filters.delete']],function(){
	Route::get('/destroy/{id}', 'FiltersController@destroy');
});
