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

Route::get('/','HomeController@index');

//Auth::routes();

Route::get('/claveunica/{redirect}','ClaveUnicaController@autenticar')->name('claveunica.autenticar');
Route::get('/claveunica/callback','ClaveUnicaController@callback')->name('claveunica.callback');

//Route::get('/home', 'HomeController@home')->name('home');
