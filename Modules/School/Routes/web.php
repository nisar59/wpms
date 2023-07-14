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

Route::group(['prefix'=>'school','middleware' => ['permission:school.view']],function(){
	Route::get('/', 'SchoolController@index');
	Route::get('/show/{id}', 'SchoolController@show');
	Route::get('/view/{id}', 'SchoolController@view');
	Route::get('/stock/{id}', 'SchoolController@stock');
});

Route::group(['prefix'=>'school','middleware' => ['permission:school.add']],function(){
	Route::get('/create', 'SchoolController@create');
	Route::POST('/store', 'SchoolController@store');
	Route::post('/add-plant/{id}', 'SchoolController@addplant');
});
Route::group(['prefix'=>'school','middleware' => ['permission:school.edit']],function(){
	Route::get('/edit/{id}', 'SchoolController@edit');
	Route::POST('/update/{id}', 'SchoolController@update');
	Route::get('/edit-plant/{id}', 'SchoolController@editplant');
	Route::post('/update-plant/{id}', 'SchoolController@updateplant');
	Route::post('/change-filter/{id}', 'SchoolController@changefilter');
	Route::post('/update-stock/{id}', 'SchoolController@updatestock');
	Route::get('status/{id}/{status}', 'SchoolController@status');




});
Route::group(['prefix'=>'school','middleware' => ['permission:school.delete']],function(){
	Route::get('/destroy/{id}', 'SchoolController@destroy');
	Route::get('/destroy-plant/{id}', 'SchoolController@destroyplant');
});
