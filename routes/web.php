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

/** User Authentication Routes */
Route::namespace('Auth\User')
    ->group(function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login');
        Route::post('/logout', 'LoginController@logout')->name('logout');

        Route::get('/register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('/register', 'RegisterController@register');

        Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.request');
        Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.email');
        Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
        Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm');
    });

/** Admin Authentication Routes */
Route::namespace('Auth\Admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login');
        Route::post('/logout', 'LoginController@logout')->name('logout');

        Route::get('/register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('/register', 'RegisterController@register');

        Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.request');
        Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.email');
        Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
        Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm');
    });

/** User Routes */
Route::namespace('User')
    ->group(function () {
        Route::get('/', 'PostController@index')->name('posts.index');
        Route::get('{post}', 'PostController@show')->name('posts.show');
        Route::get('{post}/like', 'PostController@toggleLike')->name('posts.like');
        Route::get('categories/{category}', 'CategoryController@index')->name('categories.show');
    });


Route::middleware(['web', 'admin', 'auth:admin'])
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function() {
        Route::resource('posts', 'PostController')->except('index', 'show', 'update');
        /*
         this route should be PUT method, but since FormData doesn't support PUT method
         I forced to use POST method
         */
        Route::post('posts/{post}', 'PostController@update')->name('posts.update');
        Route::resource('categories', 'CategoryController')->only('store', 'update', 'destroy');
    });