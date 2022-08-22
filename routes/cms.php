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

Route::group(['namespace' => 'CMS'], function (){
    Route::post('comments/like', 'CommentsController@like');
    Route::resource('comments', 'CommentsController');

    // Contact
    Route::post('contact', 'ContactsController@store');
    Route::get('contact', 'ContactsController@create');
    Route::get('test', 'ContactsController@test');
    Route::get('videos', 'VideosController@index');
    Route::get('products', 'ProductController@index');

    // News
    Route::get('/{alias?}nc{id}.html', 'NewsController@category')->where('id', '[0-9]+');
    Route::get('/{alias?}nt{id}.html', 'NewsController@tag')->where('id', '[0-9]+');
    Route::get('/{alias?}n{id}.html', 'NewsController@show')->where('id', '[0-9]+');

    // Videos
    Route::get('/{alias?}vc{id}.html', 'VideosController@category')->where('id', '[0-9]+');
    Route::get('/{alias?}v{id}.html', 'VideosController@show')->where('id', '[0-9]+');

    // Pages
    Route::get('/{alias?}page{id}.html', 'PagesController@show')->where('id', '[0-9]+');

    // Course
    Route::get('course/videos', 'CourseController@videos');
    Route::get('course/questions', 'CourseController@questions');
    Route::get('course/checkInfo', 'CourseController@checkInfo');
    Route::post('course/updateUser', 'CourseController@updateUser');
    Route::post('course/checkResult', 'CourseController@checkResult');
    Route::get('course/getQuestions', 'CourseController@getQuestions');
    Route::get('course/getVideos', 'CourseController@getVideos');
});

Route::group(['prefix' => 'admin/cms', 'namespace' => 'Admin\\CMS', 'middleware' => 'locale'], function (){
    Route::delete('contact/remove-list/{list}', 'ContactController@deleteListItem');
    Route::delete('news/remove-list/{list}', 'NewsController@deleteListItem');
    Route::delete('tags/remove-list/{list}', 'TagsController@deleteListItem');
    Route::delete('category/remove-list/{list}', 'CategoryController@deleteListItem');
    Route::delete('subscribe/remove-list/{list}', 'SubscribeController@deleteListItem');
    Route::delete('pages/remove-list/{list}', 'PagesController@deleteListItem');
    Route::delete('menu/remove-list/{list}', 'MenuController@deleteListItem');
    Route::delete('banners/remove-list/{list}', 'BannersController@deleteListItem');
    Route::post('comment/reply', 'CommentController@reply');
    Route::get('comment/statistic', 'CommentController@statistic');

    Route::resource('tags', 'TagsController', [
        'names' => [
            'index' => 'admin.cms.tags',
            'edit' => 'admin.cms.tags.edit',
            'create' => 'admin.cms.tags.create',
        ]
    ]);

    Route::resource('news', 'NewsController', [
        'names' => [
            'index' => 'admin.cms.news',
            'edit' => 'admin.cms.news.edit',
            'create' => 'admin.cms.news.create',
        ]
    ]);

    Route::resource('questions', 'QuestionsController', [
        'names' => [
            'index' => 'admin.cms.questions',
            'edit' => 'admin.cms.questions.edit',
            'create' => 'admin.cms.questions.create',
        ]
    ]);

    Route::resource('video_course', 'VideosCourseController', [
        'names' => [
            'index' => 'admin.cms.video_course',
            'edit' => 'admin.cms.video_course.edit',
            'create' => 'admin.cms.video_course.create',
        ]
    ]);

    Route::resource('videos', 'VideosController', [
        'names' => [
            'index' => 'admin.cms.videos',
            'edit' => 'admin.cms.videos.edit',
            'create' => 'admin.cms.videos.create',
        ]
    ]);

    Route::resource('videos_category', 'VideosCategoryController', [
        'names' => [
            'index' => 'admin.cms.videos_category',
            'edit' => 'admin.cms.videos_category.edit',
            'create' => 'admin.cms.videos_category.create',
        ]
    ]);

    Route::resource('category', 'CategoryController', [
        'names' => [
            'index' => 'admin.cms.category',
            'edit' => 'admin.cms.category.edit',
            'create' => 'admin.cms.category.create',
        ]
    ]);

    Route::resource('pages', 'PagesController', [
        'names' => [
            'index' => 'admin.cms.pages',
            'edit' => 'admin.cms.pages.edit',
            'create' => 'admin.cms.pages.create',
        ]
    ]);

    Route::resource('banners', 'BannersController', [
        'names' => [
            'index' => 'admin.cms.banners',
            'edit' => 'admin.cms.banners.edit',
            'create' => 'admin.cms.banners.create',
        ]
    ]);

    Route::resource('test', 'TestController', [
        'names' => [
            'index' => 'admin.cms.test',
            'edit' => 'admin.cms.test.edit',
            'create' => 'admin.cms.test.create',
        ]
    ]);

    Route::resource('contact', 'ContactController', [
        'names' => [
            'index' => 'admin.cms.contact',
            'edit' => 'admin.cms.contact.edit',
            'create' => 'admin.cms.contact.create',
        ]
    ]);

    Route::resource('staff', 'StaffController', [
        'names' => [
            'index' => 'admin.cms.staff',
            'edit' => 'admin.cms.staff.edit',
            'create' => 'admin.cms.staff.create',
        ]
    ]);

    Route::resource('subscribe', 'SubscribeController', [
        'names' => [
            'index' => 'admin.cms.subscribe',
            'edit' => 'admin.cms.subscribe.edit',
            'create' => 'admin.cms.subscribe.create',
        ]
    ]);

    Route::resource('comment', 'CommentController', [
        'names' => [
            'index' => 'admin.cms.comment',
            'edit' => 'admin.cms.comment.edit',
            'create' => 'admin.cms.comment.create',
        ]
    ]);

    Route::resource('menu', 'MenuController', [
        'names' => [
            'index' => 'admin.cms.menu',
            'edit' => 'admin.cms.menu.edit',
            'create' => 'admin.cms.menu.create',
        ]
    ]);
});
