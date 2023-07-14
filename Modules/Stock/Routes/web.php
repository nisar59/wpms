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


Route::group(['prefix'=>'stock','middleware' => ['permission:stock.view']],function(){
	Route::get('/', 'StockController@index');
	Route::get('/filters/{id}', 'StockController@filters');
});

Route::group(['prefix'=>'stock','middleware' => ['permission:stock.add']],function(){
	Route::get('/create', 'StockController@create');
	Route::POST('/store', 'StockController@store');

});
Route::group(['prefix'=>'stock','middleware' => ['permission:stock.edit']],function(){
	Route::get('/edit/{id}', 'StockController@edit');
	Route::POST('/update/{id}', 'StockController@update');


});
Route::group(['prefix'=>'stock','middleware' => ['permission:stock.delete']],function(){
	Route::get('/destroy/{id}', 'StockController@destroy');
});
