<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RouletteController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\CodigoController;
use Illuminate\Support\Facades\Auth;

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

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        $user = Auth::user();
        $view = '';
        switch ($user->type){
            case 1:
                $view = '/streamer';
                break;
            case 2:
                $view = '/admin';
                break;
            default:
                $view = '/user';
                break;
        }

        return redirect($view);
    });

    /* ---- SUPER USER ---- */

    Route::get('/admin', function () {
        return view('/admin/index');
    });

    Route::get('/admin/usuarios_registrados', function () {
        return view('/admin/Usuarios_Registrados');
    });

    Route::get('/admin/crear_usuarios', function () {
        return view('/admin/Crear_Usuarios');
    });
    Route::get('/admin/redes_sociales', function () {
        return view('/admin/Redes_Sociales');
    });
    Route::get('/admin/configuraciones', function () {
        return view('/admin/Configuraciones');
    });
    Route::get('/admin/configuracion_encuesta', function () {
        return view('/admin/Configuracion_Encuestas');
    });
    Route::get('/admin/configuracion_ruleta', function () {
        return view('/admin/Configuracion_Ruleta');
    });
    /* ---- / SUPER USER ---- */

    /* ---- STREAMER ---- */

    Route::get('/streamer', function () {
        return view('/streamer/index');
    });

    // modulo de configuracion para streamer
    Route::get('/streamer/config', [ConfiguracionController::class, 'index']);

    Route::get('/streamer/message', [MessageController::class, 'index']);
    Route::get('/streamer/roulette', [RouletteController::class, 'index']);

    Route::get('/streamer/spin_roulette', function (){
        return view('streamer.spin_roulette');
    });

    /* ---- /STREAMER ---- */

    /* ---- USER ---- */

    Route::get('/user', function () {
        return view('/user/index');
    });

    /* ---- / USER ---- */

});


/* ---- / AUTH ROUTES ---- */

// modulo de codigos para streamer 
Route::get('/streamer/codigos', [CodigoController::class, 'index'])->name('streamer.codigos');

/* ---- /STREAMER ---- */
/* ---- PUBLIC ROUTES ---- */


/* ---- / PUBLIC ROUTES ---- */


