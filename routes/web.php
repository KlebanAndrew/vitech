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
Route::get('auth/login/', 'Auth\LoginController@showLoginForm');
Route::get('auth/register/', 'Auth\RegisterController@showRegistrationForm');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{one?}/{two?}/{three?}/{four?}/{five?}', function () {
    return view('welcome');
});
