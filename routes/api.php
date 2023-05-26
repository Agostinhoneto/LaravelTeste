<?php

use Illuminate\Http\Request;


/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
/*Reports*/

Route::get('reports', 'ReportController@index');
Route::post('reports/store', 'ReportController@store');
Route::get('/reports/show/{id}', 'ReportController@show');
Route::put('reports/update/{id}', 'ReportController@update');
Route::delete('reports/delete/{id}', 'ReportController@destroy');
Route::post('reports/sendmail','ReportController@sendmail');

/* Profiles */
Route::get('profiles', 'ProfileController@index');
Route::get('profiles/{id}', 'ProfileController@show');
Route::post('profiles/store', 'ProfileController@store');
Route::get('profiles/{profile}', 'ProfileController@show');
Route::put('profiles/{profile}', 'ProfileController@update');
Route::delete('profiles/{profile}', 'ProfileController@destroy');
Route::get('profiles/show/{id}', 'ProfileController@show');
