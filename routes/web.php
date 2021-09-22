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


Auth::routes();

Route::group(['middleware' => 'auth'] , function () {

    Route::redirect('/', 'dashboard');

    Route::redirect('/home', 'dashboard');

    Route::post('update-profile', 'ProfileController')->name('update-profile');

    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    Route::resource('blog' , 'BlogController');

    Route::group( ['middleware' => 'admin'], function () {
        Route::resource('user' , 'UserController');

        Route::get('supervisor', 'SupervisorController')->name('supervisors.index');
    });

    Route::group( ['middleware' => 'supervisor'], function () {
        Route::resource('user' , 'UserController');
    });

});
