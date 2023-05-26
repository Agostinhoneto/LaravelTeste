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

//profiles
Route::resource('profiles', 'ProfileController');

//reports
//Route::resource('reports', 'ReportController');
Route::get('/reports', 'ReportController@index')->name('reports.index');
Route::get('/reports/create', 'ReportController@create')->name('reports.create');
Route::post('/reports/store', 'ReportController@store')->name('reports.store');

Route::put('/reports/update/{id}', 'ReportController@update')->name('reports.update');
Route::get('/reports/show/{id}', 'ReportController@show')->name('reports.show');
Route::get('/reports/edit/{id}', 'ReportController@edit')->name('reports.edit');
Route::delete('/reports/destroy/{id}', 'ReportController@destroy')->name('reports.destroy');
Route::get('reports/pdf','ReportController@generatePDF')->name('reports.pdf');

/////
Route::get('reports/gerar','ReportController@gerarRelatorio')->name('reports.gerar');
Route::get('reports/enviarEmail/{attachmentPath}','ReportController@enviarEmail')->name('reports.enviar');
//////////////////


Route::post('/save-report', 'ReportController@saveAndSendReport');
