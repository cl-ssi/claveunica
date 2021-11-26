<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClaveUnicaController;

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

/* Rutas para implementar clave única */
Route::get('/claveunica',[ClaveUnicaController::class,'autenticar'])->name('claveunica.autenticar');
Route::get('/claveunica/callback',[ClaveUnicaController::class,'callback'])->name('claveunica.callback');

//Route::get('/home', 'HomeController@home')->name('home');
