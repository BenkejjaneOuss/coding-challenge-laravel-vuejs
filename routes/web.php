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

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/home', 'HomeController@index')->name('home');

//Change Password 
Route::get('/profile', 'profileController@index')->name('profile');
Route::post('/profile', 'ProfileController@changePassword')->name('changePassword');