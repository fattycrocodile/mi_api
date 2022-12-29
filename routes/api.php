<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('mserver', 'MiServerController');
Route::apiResource('mserver_log', 'MiServerLogController');
Route::apiResource('mkey', 'MiKeyInformationController');
Route::apiResource('mklog', 'MiKeyLogController');

Route::apiResource('task', 'TaskController')->except(['index', 'store', 'destroy']);
Route::get('ping/servers', 'TaskController@update_servers')->name('task.servers-update');
Route::get('task/server/{$id}', 'TaskController@update_server')->name('task.server-update');
