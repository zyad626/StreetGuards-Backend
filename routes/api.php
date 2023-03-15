<?php

use App\Http\Controllers\API\ProductsController;
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

    
    Route::middleware('auth:sanctum')->group(function () {
        // protected API routes
        Route::get('/users/{id}', [UsersController_new::class, 'getUser']);
        Route::post('/users/logout', [UsersController_new::class, 'logout']);
        Route::delete('/users/{id}', [UsersController_new::class, 'destroy']);
        Route::put('/users/{id}', [UsersController_new::class, 'update']);

        Route::middleware('throttle:10,1')->post('/products', 'ProductsController@create');
        Route::delete('/products/{id}', [ProductsController::class, 'destroy']);
        Route::put('/products/{id}', [ProductsController::class, 'update']);

    });
    //new user APIs
    Route::post('/users/login', [UsersController_new::class, 'login']);
    Route::middleware('throttle:10,1')->post('/users', 'UsersController_new@create');
    //incidents APIs
    Route::get('/all', 'IncidentsController@index');
    Route::middleware('throttle:10,1')->post('/add', 'IncidentsController@create');
    Route::middleware('throttle:10,1')->post('/incidents', 'IncidentsController@create');
    Route::get('/incidents', 'IncidentsController@list'); //incident type must be specified in query
    //files API
    Route::middleware('throttle:50,1')->post('/upload', 'FilesController@upload');
    Route::middleware('throttle:50,1')->post('/files', 'FilesController@create');

    //old user APIs
    Route::get('/user', 'UsersController@getUser');
    Route::post('/user/create', 'UsersController@create');

    //Products APIs
    Route::get('/products/{id}', [ProductsController::class, 'getProduct']);
    Route::get('/products', 'ProductsController@index');


});



