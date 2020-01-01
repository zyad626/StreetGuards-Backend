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
     * Files
     */
    Route::prefix('files')->group(function () {
        Route::get('/view/{vid}', 'FilesController@view')->name('admin.files.view');
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

Route::get('/', function () {
    $lat = 30.272662;
    $lng = 31.393483;
    $zoom = 8;
    
    if (false) {
        $ipAddress = '105.36.4.227';
        $lat = $location['latitude'];
        $lng = $location['longitude'];
        $zoom = 16;
    }

    $data = [
        'lat' => $lat,
        'lng' => $lng,
        'zoomLevel' => $zoom
    ];
    return view('site.home', $data);
})->name('site.home');


Route::get('/contact-us', function () {
    return view('site.contact_us');
})->name('site.contactus');