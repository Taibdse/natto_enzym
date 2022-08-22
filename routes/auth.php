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

// Member on Frontend login
Auth::routes([
    'register' => false,
    'verify' => false,
    'reset' => true
]);

Route::get('logout', 'Auth\\LoginController@logout');

// Facebook login
Route::group(["prefix" => "facebook", 'namespace' => 'Auth'], function() {
    Route::get('checkLogin', 'FacebookAuthController@checkLogin');
    Route::get('login', 'FacebookAuthController@login');
});

// Google Login
Route::group(["prefix" => "auth", 'namespace' => 'Auth'], function() {
    Route::get('google', 'GoogleAuthController@getGoogle');
    Route::get('google/callback', 'GoogleAuthController@setGoogle');
});


// Admin login
Route::group(["prefix" => "admin", 'namespace' => 'Admin\\System'], function() {
    Route::get('login', 'AdminLoginController@showLoginForm')->name('admin.login');
    Route::get('logout', 'AdminLoginController@logout')->name('admin.logout');
    Route::post('login', 'AdminLoginController@login');
});

// Google auth code
Route::group(["middleware" => ["web"], "prefix" => "2fa", 'namespace' => 'Admin\\System'], function() {
    Route::get("/", "TwoStepAuthController@index")->name("2fa_scan");
    Route::post("enable", "TwoStepAuthController@enable")->name("2fa_enable");
    Route::post("verify", "TwoStepAuthController@verify")->name("2fa_verify");
    Route::post('generate', 'TwoStepAuthController@generateGAC');
});

