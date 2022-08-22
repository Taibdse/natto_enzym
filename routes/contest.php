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

Route::group(['namespace' => 'Contest'], function (){
    Route::get('contest/share', 'ContestController@share');
    Route::get('contest/vote', 'ContestController@vote');
    Route::resource('contest', 'ContestController');
});

Route::group(['prefix' => 'admin/contest', 'namespace' => 'Admin\\Contest', 'middleware' => ['admin', 'locale']], function (){
    Route::delete('category/remove-list/{list}', 'CategoryController@deleteListItem');
    Route::delete('contest/remove-list/{list}', 'ContestController@deleteListItem');
    Route::get('mail', 'ContestController@mail');

    Route::resource('contest', 'ContestController', [
        'names' => [
            'index' => 'admin.contest.contest',
            'edit' => 'admin.contest.contest.edit',
            'create' => 'admin.contest.contest.create'
        ]
    ]);
    Route::resource('category', 'CategoryController', [
        'names' => [
            'index' => 'admin.contest.category',
            'edit' => 'admin.contest.category.edit',
            'create' => 'admin.contest.category.create',
        ]
    ]);
    Route::get('logs', 'LogsController@index')->name('admin.contest.logs');
    Route::resource('statistic', 'StatisticController', [
        'names' => [
            'index' => 'admin.contest.statistic'
        ]
    ]);
    Route::resource('config', 'ConfigController', [
        'names' => [
            'index' => 'admin.contest.config',
        ]
    ]);
});


