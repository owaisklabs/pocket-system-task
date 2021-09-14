<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/{any}', 'ApplicationController')->where('any', '.*');

Auth::routes();
Route::get('/', function () {
    if (Auth::user()) {
        return redirect()->route('home');
    }
    else{
        return redirect()->route('login');
    }
});



Route::get('/home', 'HomeController@index')->name('home');
Route::post('store','HomeController@store')->name('store');
Route::get('show','HomeController@show')->name('show');
Route::post('update','HomeController@update')->name('update');
Route::get('delete','HomeController@delete')->name('delete');

