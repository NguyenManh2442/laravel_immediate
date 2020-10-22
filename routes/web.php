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
Route::resource('/user', 'UserController', ['only' => ['index', 'create', 'store']])->name('*','user');

//Route::get('/login','UserController@formLogin')->name('formLogin')->middleware("CheckUser");
//Route::post('/login', 'UserController@login')->name('login')->middleware("throttle:5,2");
//Route::get('/logout', 'UserController@logout')->name('logout');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
