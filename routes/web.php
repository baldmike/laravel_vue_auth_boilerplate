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
Route::get('/', 'SpaController@index');

Route::get('/dashboard', 'SpaController@index');
Route::get('/dogs', 'SpaController@index');
Route::get('/cats', 'SpaController@index');

Route::get('/{any}', 'SpaController@notFound')->where('any', '.*');
// Auth::routes();
