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

Route::get('tasks', 'TasksController@index');
Route::get('tasks/{id}', 'TasksController@show');
Route::post('tasks', 'TasksController@store');
Route::put('tasks/{id}', 'TasksController@update');
Route::delete('tasks/{id}', 'TasksController@delete');
