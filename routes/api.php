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
Route::middleware('api')->post('/register' , 'APIControllers\AuthController@register');
Route::middleware('api')->post('/login' , 'APIControllers\AuthController@login');

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/rocket', 'APIControllers\RocketController@index');
    Route::post('/rocket', 'APIControllers\RocketController@favorites');
});

Route::resource('notes', 'APIControllers\NotesController', ['only' => [
    'index', 'store', 'update', 'destroy'
]]);