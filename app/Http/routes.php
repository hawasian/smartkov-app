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

// Home
Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/','TextController@generateText')->name('generate');

// About
Route::get('/about', function () {
    return view('about');
})->name('about');

// Login
Route::get('/admin', function(){
    if(!Auth::guest()){
        return redirect()->route('edit');
    }else{
        return redirect()->route('signin');
    }
})->name('admin');

Route::get('/login', function () {
    return view('login');
})->name('signin');

Route::post('/login', 'AccountController@login')->name('login');
Route::get('/logout', 'AccountController@logout')->name('logout')->middleware('checklogin');

Route::get('/change', function () {
    return view('change');
})->name('change');
Route::post('/change', 'AccountController@change')->name('reset');

//Edit
Route::get('/edit', function () {
    return view('edit');
})->name('edit');

Route::get('/edit/new', function () {
    return view('new');
})->name('new');

Route::post('/edit/new', 'TextController@addText')->name('add');
Route::get('/edit/delete/{id}', ['uses' => 'TextController@deleteText'])->name('delete');
Route::get('/edit/edit/{id}', ['uses' => 'TextController@editText'])->name('edittext');
Route::post('/edit/edit/{id}', ['uses' => 'TextController@postText'])->name('posttext');

Route::get('/fetch', 'TextController@updateJSON')->name('updateJSON');




