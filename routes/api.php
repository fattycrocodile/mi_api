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
// Route::get('mi_servers', 'MiServerController@index');
// Route::get('mi_servers/{mi_server}', 'MiServerController@show');
// Route::post('mi_servers', 'MiServerController@store');
// Route::put('mi_servers/{mi_server}', 'MiServerController@update');
// Route::delete('mi_servers/{mi_server}', 'MiServerController@delete');

Route::apiResource('mserver_log', 'MiServerLogController');
// Route::get('mi_servers/{mi_server}/mi_server_logs', 'MiServerLogController@index');
// Route::post('mi_servers/{mi_server}/mi_server_logs', 'MiServerLogController@store');
// Route::put('mi_servers/mi_server_logs/{mi_server_log}', 'MiServerLogController@update');
// Route::delete('mi_servers/mi_server_logs/{mi_server_log}', 'MiServerLogController@delete');


Route::apiResource('mkey', 'MiKeyInformationController');
// Route::get('mi_servers/{mi_server}/mi_key_informations', 'MiKeyInformationController@index');
// Route::post('mi_servers/{mi_server}/mi_key_informations', 'MiKeyInformationController@store');
// Route::put('mi_servers/mi_key_informations/{mi_key_information}', 'MiKeyInformationController@update');
// Route::delete('mi_servers/mi_key_informations/{mi_key_information}', 'MiKeyInformationController@delete');

Route::apiResource('mklog', 'MiKeyLogController');
// Route::get('mi_key_informations/{mi_key_information}/mi_key_logs', 'MiKeyLogController@index');
// Route::post('mi_key_informations/{mi_key_information}/mi_key_logs', 'MiKeyLogController@store');
// Route::put('mi_key_informations/mi_key_logs/{mi_key_log}', 'MiKeyLogController@update');
// Route::delete('mi_key_informations/mi_key_logs/{mi_key_log}', 'MiKeyLogController@delete');
