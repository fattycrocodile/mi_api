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
Route::get('mi-sla-cron', 'TaskController@update_servers_cron')->name('task.cron.server-update');

Route::get('lenovo/key', 'UnisocRSAKeyController@lenovo_keys')->name('lenovo.keys');
Route::get('itel/key', 'UnisocRSAKeyController@itel_keys')->name('itel.keys');


Route::post('itel/key', 'UnisocRSAKeyController@generate_itel_key')->name('itel.key-generate');
Route::put('itel/key/{key}', 'UnisocRSAKeyController@update_itel_key')->name('itel.key-update');
Route::post('lenovo/key', 'UnisocRSAKeyController@generate_lenovo_key')->name('lenovo.key-generate');
Route::put('lenovo/key/{key}', 'UnisocRSAKeyController@update_lenovo_key')->name('lenovo.key-update');

Route::post('xetoken', 'MiSLALoaderController@xetoken')->name('xetoken.generate');
