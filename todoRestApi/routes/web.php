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
Route::get('/read', 'restController@read');
Route::get('/read/{id}', 'restController@readsingle');
Route::any('/create', 'restController@create');
Route::put('/update/{id}', 'restController@update');
Route::delete('/delete/{id}', 'restController@delete');

