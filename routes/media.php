<?php

/*
|--------------------------------------------------------------------------
| Media Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MediaController@index');
Route::post('/uploadImage', 'MediaController@uploadImage');
Route::post('/uploadVideo', 'MediaController@uploadVideo');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function (){
    Route::get('/', 'MediaController@adminIndex')->name('media.admin.index');

    Route::post('/update', 'MediaController@adminUpdate')->name('media.admin.update');
    Route::post('/delete', 'MediaController@adminDelete')->name('media.admin.delete');

    Route::post('uploadBase64', 'MediaController@uploadBase64')
        ->name('media.admin.uploadBase64');

    Route::post('upload', 'MediaController@adminUpload')
        ->name('media.admin.upload');
});


