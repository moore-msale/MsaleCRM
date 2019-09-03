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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/call_to_customer', 'CallController@call_to_customer')->name('call_to_customer');

Route::resource('task', 'TaskController');
Route::resource('meeting', 'MeetingController');
Route::resource('report', 'ReportController');
Route::get('/excel/create', 'ExcelController@create')->name('excel.create');
Route::post('/excel', 'ExcelController@import')->name('excel.import');
Route::get('/delete/calls', 'CallController@cronDelete');
Route::get('/mail', 'ReportController@mail');
