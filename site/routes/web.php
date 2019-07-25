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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'IndexController@index')->name('index');
    Route::resource('menu', 'MenuController');
    Route::resource('book', 'BookController');
    Route::resource('option', 'OptionController');
    Route::resource('spider', 'SpiderController');
    Route::resource('chapter', 'ChapterController');
    Route::get('bookreset/{id}','BookController@reset')->name('book.reset');
    Route::resource('log', 'LogController');
});








