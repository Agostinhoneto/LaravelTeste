<?php

use Illuminate\Http\Request;


/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

/*Reports API*/

Route::get('reports', 'ReportController@index');
Route::post('reports/store', 'ReportController@store');
Route::get('reports/show/{id}', 'ReportController@show');
Route::put('reports/update/{id}', 'ReportController@update');
Route::delete('reports/delete/{id}', 'ReportController@destroy');
//Route::post('reports/sendmail/{id}','ReportController@sendmail');
Route::post('/reports/{id}/send-email', 'ReportController@sendmail');

/* Profiles API*/
Route::get('profiles', 'ProfileController@index');
Route::get('profiles/show/{id}', 'ProfileController@show');
Route::post('profiles/store', 'ProfileController@store');
Route::put('profiles/update/{id}', 'ProfileController@update');
Route::delete('profiles/delete/{id}', 'ProfileController@destroy');
