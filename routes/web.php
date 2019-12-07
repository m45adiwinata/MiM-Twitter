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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'HomeController@index')->name('home');
Route::get('/register-login', 'UserController@index')->name('relog');
Route::post('/login', 'UserController@login')->name('login');
Route::post('/register', 'UserController@register')->name('register');
Route::get('/profile/{id}', 'UserController@profile')->name('profile');
Route::post('/profile/{id}', 'UserController@update')->name('update-profile');
Route::get('/logout', 'UserController@logout')->name('logout');