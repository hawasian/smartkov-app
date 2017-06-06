<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('sample');
});
Route::get('/login', function () {
    return view('sample');
})->name('signin');

Route::post('/login', 'AccountController@login')->name('login');

Route::get('/logout', 'AccountController@logout')->name('logout')->middleware('checklogin');;

Route::get('/change', function () {
    return view('change');
})->name('change');

Route::post('/change', 'AccountController@change')->name('reset');

Route::get('/pass', function () {
    return view('welcome');
})->name('pass')->middleware('checklogin');

Route::get('/fail', function () {
    return view('sample');
})->name('fail');
