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

Route::group(['prefix'=>'plants','middleware' => ['permission:plants.view']],function(){
	Route::get('/', 'PlantsController@index');
});

Route::group(['prefix'=>'plants','middleware' => ['permission:plants.add']],function(){
	Route::get('/create', 'PlantsController@create');
	Route::POST('/store', 'PlantsController@store');

});
Route::group(['prefix'=>'plants','middleware' => ['permission:plants.edit']],function(){
	Route::get('/edit/{id}', 'PlantsController@edit');
	Route::POST('/update/{id}', 'PlantsController@update');


});
Route::group(['prefix'=>'plants','middleware' => ['permission:plants.delete']],function(){
	Route::get('/destroy/{id}', 'PlantsController@destroy');
});
