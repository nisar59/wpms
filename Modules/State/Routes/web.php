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

Route::group(['prefix'=>'state','middleware' => ['permission:state.view']],function(){
	Route::get('/', 'StateController@index');
});

Route::group(['prefix'=>'state','middleware' => ['permission:state.add']],function(){
	Route::get('/create', 'StateController@create');
	Route::POST('/store', 'StateController@store');

});
Route::group(['prefix'=>'state','middleware' => ['permission:state.edit']],function(){
	Route::get('/edit/{id}', 'StateController@edit');
	Route::POST('/update/{id}', 'StateController@update');


});
Route::group(['prefix'=>'state','middleware' => ['permission:state.delete']],function(){
	Route::get('/destroy/{id}', 'StateController@destroy');
});
