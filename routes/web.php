<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ConfiguracionController;

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


/* ---- AUTH ROUTES ---- */

Route::view('home','home')->middleware('auth');

/* ---- / AUTH ROUTES ---- */

/* ---- PUBLIC ROUTES ---- */

Route::get('/', function () {
    return view('welcome');
});

/* ---- / PUBLIC ROUTES ---- */

/* ---- SUPER USER ---- */

Route::get('/admin', function () {
    return view('/admin/index');
});

/* ---- / SUPER USER ---- */


/* ---- STREAMER ---- */

Route::get('/streamer', function () {
    return view('/streamer/index');
});

// modulo de configuracion para streamer
Route::get('/streamer/config', [ConfiguracionController::class, 'index']);

/* ---- /STREAMER ---- */

Route::get('/message', [MessageController::class, 'index']);


/* ---- USER ---- */
Route::get('/user', function () {
    return view('/user/index');
});

