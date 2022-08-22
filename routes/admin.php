<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'DashboardController@index')->name('admin.dashboard');
Route::get('menu/counter', 'DashboardController@counter');

Route::get('change-language/{lang}', 'CMS\LanguageController@changeLanguage')
    ->where('lang', '[a-z]+')
    ->name('admin.changLanguage');

Route::group(['prefix' => 'system', 'namespace' => 'System', 'middleware' => ['auth', 'locale']], function (){
    Route::delete('users/remove-list/{list}', 'UsersController@deleteListItem');
    Route::delete('admin/remove-list/{list}', 'AdminController@deleteListItem');
    Route::delete('role/remove-list/{list}', 'RoleController@deleteListItem');
    Route::delete('language/remove-list/{list}', 'LanguageController@deleteListItem');

    Route::resource('users', 'UsersController', [
        'names' => [
            'index' => 'admin.system.users',
            'edit' => 'admin.system.users.edit',
            'create' => 'admin.system.users.create',
        ]
    ]);

    Route::resource('language', 'LanguageController', [
        'names' => [
            'index' => 'admin.system.language',
            'edit' => 'admin.system.language.edit',
            'create' => 'admin.system.language.create',
        ]
    ]);

    Route::get('admin/profile', 'AdminController@profile')
        ->name('admin.system.admin.profile');

    Route::post('admin/profile', 'AdminController@profile');

    Route::resource('admin', 'AdminController', [
        'names' => [
            'index' => 'admin.system.admin',
            'edit' => 'admin.system.admin.edit',
            'create' => 'admin.system.admin.create',
        ]
    ]);

    Route::resource('setting', 'SettingController', [
        'names' => [
            'index' => 'admin.system.setting',
        ]
    ]);

    Route::resource('role', 'RoleController', [
        'names' => [
            'index' => 'admin.system.role',
            'edit' => 'admin.system.role.edit',
            'create' => 'admin.system.role.create',
        ]
    ]);

    Route::resource('backup', 'BackupController', [
        'names' => [
            'index' => 'admin.system.backup',
        ]
    ]);

    Route::resource('cache', 'CacheController', [
        'names' => [
            'index' => 'admin.system.cache',
        ]
    ]);

    Route::get('information/php', 'InformationController@php')
        ->name('admin.system.information.php');

    Route::get('information/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')
        ->name('admin.system.information.logs');

    Route::resource('information', 'InformationController', [
        'names' => [
            'index' => 'admin.system.information',
        ]
    ]);

    Route::get('log-admin', 'LogController@view');

});
