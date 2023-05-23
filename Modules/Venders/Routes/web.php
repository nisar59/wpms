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

Route::group(['prefix'=>'venders','middleware' => ['permission:venders.view']],function(){
	Route::get('/', 'VendersController@index');
});

Route::group(['prefix'=>'venders','middleware' => ['permission:venders.add']],function(){
	Route::get('/create', 'VendersController@create');
	Route::POST('/store', 'VendersController@store');

});
Route::group(['prefix'=>'venders','middleware' => ['permission:venders.edit']],function(){
	Route::get('/edit/{id}', 'VendersController@edit');
	Route::POST('/update/{id}', 'VendersController@update');


});
Route::group(['prefix'=>'venders','middleware' => ['permission:venders.delete']],function(){
	Route::get('/destroy/{id}', 'VendersController@destroy');
});
