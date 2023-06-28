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

/*Route::prefix('waterqualitytest')->group(function() {
    Route::get('/', 'WaterQualityTestController@index');
});*/


Route::group(['prefix'=>'water-quality-test','middleware' => ['permission:water-quality-test.view']],function(){
    Route::get('/', 'WaterQualityTestController@index');
});

Route::group(['prefix'=>'water-quality-test','middleware' => ['permission:water-quality-test.add']],function(){
    Route::get('/create', 'WaterQualityTestController@create');
    Route::POST('/store', 'WaterQualityTestController@store');

});
Route::group(['prefix'=>'water-quality-test','middleware' => ['permission:water-quality-test.edit']],function(){
    Route::get('/edit/{id}', 'WaterQualityTestController@edit');
    Route::POST('/update/{id}', 'WaterQualityTestController@update');


});
Route::group(['prefix'=>'water-quality-test','middleware' => ['permission:water-quality-test.delete']],function(){
    Route::get('/destroy/{id}', 'WaterQualityTestController@destroy');
});