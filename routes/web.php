<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

//PROFILES
Route::get('/profiles', 'ProfileController@index')->name('profiles.index');
Route::get('/profiles/create', 'ProfileController@create')->name('profiles.create');
Route::post('/profiles/store', 'ProfileController@store')->name('profiles.store');
Route::put('/profiles/update/{id}', 'ProfileController@update')->name('profiles.update');
Route::get('/profiles/show/{id}', 'ProfileController@show')->name('profiles.show');
Route::get('/profiles/edit/{id}', 'ProfileController@edit')->name('profiles.edit');
Route::delete('/profiles/destroy/{id}', 'ProfileController@destroy')->name('profiles.destroy');

//REPORTS
Route::get('/reports', 'ReportController@index')->name('reports.index');
Route::get('/reports/create', 'ReportController@create')->name('reports.create');
Route::post('/reports/store', 'ReportController@store')->name('reports.store');
Route::put('/reports/update/{id}', 'ReportController@update')->name('reports.update');
Route::get('/reports/show/{id}', 'ReportController@show')->name('reports.show');
Route::get('/reports/edit/{id}', 'ReportController@edit')->name('reports.edit');
Route::delete('/reports/destroy/{id}', 'ReportController@destroy')->name('reports.destroy');
Route::get('/reports/pdf','ReportController@generatePDF')->name('reports.pdf');
//Route::post('/reports/sendmail/{id}','ReportController@sendmail');

Route::post('/reports/{id}/send-email', 'ReportController@sendEmail');
