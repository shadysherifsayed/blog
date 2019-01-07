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
Route::namespace ('Auth\User')
    ->group(function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login');
        Route::post('/logout', 'LoginController@logout')->name('logout');

        Route::get('/register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('/register', 'RegisterController@register');

    });

/** Admin Authentication Routes */
Route::namespace ('Auth\Admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login');
        Route::post('/logout', 'LoginController@logout')->name('logout');

        Route::get('/register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('/register', 'RegisterController@register');
    });

Route::middleware(['web', 'admin', 'auth:admin'])
    ->namespace('Admin')
    ->group(function () {
        Route::resource('posts', 'PostController')->except('index', 'show');
        Route::resource('categories', 'CategoryController')->only('store', 'update', 'destroy');
    });

/** User Routes */
Route::namespace ('User')
    ->group(function () {
        Route::get('/', 'PostController@index')->name('posts.index');
        Route::get('{post}', 'PostController@show')->name('posts.show');
        Route::get('categories/{category}', 'CategoryController@show')->name('categories.show');
    });
