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

Route::group(['prefix'=>'vendors','middleware' => ['permission:vendors.view']],function(){
    Route::get('/', 'VendorsController@index');
});

Route::group(['prefix'=>'vendors','middleware' => ['permission:vendors.add']],function(){
    Route::get('/create', 'VendorsController@create');
    Route::POST('/store', 'VendorsController@store');

});
Route::group(['prefix'=>'vendors','middleware' => ['permission:vendors.edit']],function(){
    Route::get('/edit/{id}', 'VendorsController@edit');
    Route::POST('/update/{id}', 'VendorsController@update');


});
Route::group(['prefix'=>'vendors','middleware' => ['permission:vendors.delete']],function(){
    Route::get('/destroy/{id}', 'VendorsController@destroy');
});