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

/**
 * Admin Routes
 */
Route::namespace('Admin')->prefix('admin')->group(function () {
    /**
     * Home
     */
    Route::get('/', 'HomeController@index')->name('admin.home');


    /**
     * Admins
     */
    Route::prefix('admins')->group(function () {
        Route::get('/', 'AdminsController@index')->name('admin.admins');
        Route::get('/create', 'AdminsController@create')->name('admin.admins.create');
        Route::post('/store', 'AdminsController@store')->name('admin.admins.store');
        Route::get('/edit/{id}', 'AdminsController@edit')->name('admin.admins.edit');
        Route::post('/update/{id}', 'AdminsController@update')->name('admin.admins.update');
    });


    /**
     * Incidents
     */
    Route::prefix('incidents')->group(function () {
        Route::get('/', 'IncidentsController@index')->name('admin.incidents');
        Route::get('/view/{id}', 'IncidentsController@view')->name('admin.incidents.view');
        Route::get('/delete/{id}', 'IncidentsController@delete')->name('admin.incidents.delete');
    });

    /**
     * Messages
     */
    Route::prefix('messages')->group(function () {
        Route::get('/', 'MessagesController@index')->name('admin.messages');
    });

    /**
     * Files
     */
    Route::prefix('files')->group(function () {
        Route::get('/', 'FilesController@index')->name('admin.files');
        Route::get('/view/{id}', 'FilesController@view')->name('admin.files.view');
    });

    Route::prefix('map')->group(function () {
        Route::get('/', 'MapsController@index')->name('admin.map');
        Route::get('/incidents', 'MapsController@incidents')->name('admin.map.incidents');
    });

    /**
     * Admin Authentication
     */
    Route::match(['get', 'post'], '/auth/login', 'AuthController@login')->name('admin.auth.login');
    Route::get('/auth/logout', 'AuthController@logout')->name('admin.auth.logout');
});

Route::get('/', 'HomeController@index')->name('site.home');
Route::get('/about-us', 'HomeController@aboutUs')->name('site.about-us');
Route::post('/contact', 'HomeController@postContact')->name('site.post-contact');
Route::get('/success', 'HomeController@successContact')->name('site.success-contact');
