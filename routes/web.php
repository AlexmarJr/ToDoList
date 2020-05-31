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
Route::get('news', 'HomeController@news')->name('news');
Route::post('saveTask', 'HomeController@store_task')->name('store_task');
Route::get('home/{id?}', 'HomeController@read')->name('read');
Route::get('delete/{id?}', 'HomeController@delete')->name('delete');
Route::get('update/{id?}', 'HomeController@taskFinished')->name('update');
Route::get('/historic', 'HomeController@historic')->name('historic');
Route::get('/deleteAll', 'HomeController@deleteAll')->name('deleteAll');