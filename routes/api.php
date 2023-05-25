<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('reports', 'ReportController@index');
Route::post('reports', 'ReportController@store');
Route::get('reports/{id}', 'ReportController@show');
Route::put('reports/{id}', 'ReportController@update');
Route::delete('reports/{id}', 'ReportController@destroy');

