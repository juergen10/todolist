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

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'CardTaskController@index')->name('home');
Route::post('/add', 'CardTaskController@create')->name('add');
Route::post('/edit', 'CardTaskController@edit')->name('editcard');
Route::post('/delete', 'CardTaskController@delete')->name('deletecard');
