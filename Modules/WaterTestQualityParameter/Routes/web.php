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

Route::group(['prefix'=>'water-test-quality-parameter','middleware' => ['permission:water-quality-test.view']],function(){
    Route::get('/', 'WaterTestQualityParameterController@index');
});

Route::group(['prefix'=>'water-test-quality-parameter','middleware' => ['permission:water-quality-test.add']],function(){
    Route::get('/create', 'WaterTestQualityParameterController@create');
    Route::POST('/store', 'WaterTestQualityParameterController@store');

});
Route::group(['prefix'=>'water-test-quality-parameter','middleware' => ['permission:water-quality-test.edit']],function(){
    Route::get('/edit/{id}', 'WaterTestQualityParameterController@edit');
    Route::POST('/update/{id}', 'WaterTestQualityParameterController@update');


});
Route::group(['prefix'=>'water-test-quality-parameter','middleware' => ['permission:water-quality-test.delete']],function(){
    Route::get('/destroy/{id}', 'WaterTestQualityParameterController@destroy');
});