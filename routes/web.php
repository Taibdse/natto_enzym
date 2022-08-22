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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/theme/{theme}/{page}', function ($theme, $page) {
    return view($theme.'.pages.'.$page);
})->name('theme_page');

Route::get('/pages/{view}', function ($view) {
    if ($view == 'rule' || $view == 'online_quiz') {
        if (!\Auth::user()) {
            return redirect('/');
        }
    }
    return view('natto.pages.'.$view);
});
Route::get('/pages/test/{view}', function ($view) {
    return view('natto.pages.test.'.$view);
});

Route::get('offline', function (){
    return view('layouts.offline');
})->name('offline');

Route::get('/oauth/gmail', function (){
    return Dacastro4\LaravelGmail\Facade\LaravelGmail::redirect();
});

Route::get('/oauth/gmail/callback', function (){
    Dacastro4\LaravelGmail\Facade\LaravelGmail::makeToken();
    return redirect()->to('/');
});
