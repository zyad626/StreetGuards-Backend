<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use App\Http\Controllers\API\UsersController_new;

Route::group(['namespace' => 'API'], function () {
    Route::middleware('throttle:10,1')->post('/incidents', 'IncidentsController@create');
    
    Route::get('/incidents', 'IncidentsController@list');

    // Route::get('/users/{id}', 'UsersController@getUser');
    Route::get('/users/{id}', [UsersController_new::class, 'getUser']);
    Route::delete('/users/{id}', [UsersController_new::class, 'destroy']);
    Route::middleware('throttle:10,1')->post('/users', 'UsersController_new@create');
    Route::put('/users/{id}', [UsersController_new::class, 'update']);

    Route::middleware('throttle:50,1')->post('/files', 'FilesController@create');
});
