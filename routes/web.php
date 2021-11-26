<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

//Auth::routes();
/* Dejo la ruta para el logout solamente de laravel */
Route::get('/logout', [LoginController::class,'logout'])->name('logout');

/* Rutas para implementar clave única */
Route::get('/claveunica',[ClaveUnicaController::class,'autenticar'])->name('claveunica.autenticar');
Route::get('/claveunica/callback',[ClaveUnicaController::class,'callback'])->name('claveunica.callback');
Route::get('/claveunica/logout', [ClaveUnicaController::class,'logout'])->name('claveunica.logout');


Route::get('/',     [HomeController::class,'index']);
Route::get('/home', [HomeController::class,'home'])->name('home');
