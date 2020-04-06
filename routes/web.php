<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/home/nsl', 'HomeController@nsl')->name('nsl');
Route::get('/home/myip', 'HomeController@myip')->name('myip');
Route::get('/home/profile', 'HomeController@profile')->name('profile');

Route::post('/home/myip/add', 'IPController@add')->name('add');
Route::post('/home/myip/del', 'IPController@del')->name('del');
Route::post('/home/myip/edit', 'IPController@edit')->name('edit');

Route::post('/home/nsl/del', 'IPController@del_admin')->name('del_admin');
Route::post('/home/nsl/edit', 'IPController@edit_admin')->name('edit_admin');