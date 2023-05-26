<?php

use Illuminate\Http\Request;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*Reports*/

Route::get('/reports', 'ReportController@index');
Route::post('/reports/create', 'ReportController@store');
Route::get('/reports/show/{id}', 'ReportController@show');
Route::put('/reports/update/{id}', 'ReportController@update');
Route::delete('/reports/delete/{id}', 'ReportController@destroy');

/* Profiles */
Route::get('profiles', 'ProfileController@index');
Route::post('profiles/create', 'ProfileController@store');
Route::get('profiles/{profile}', 'ProfileController@show');
Route::put('profiles/{profile}', 'ProfileController@update');
Route::delete('profiles/{profile}', 'ProfileController@destroy');
