<?php

use App\Http\Controllers\AdminConfigurationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RouletteController;
use App\Http\Controllers\VotacionesController;
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

    Route::get('/admin/usuarios', [AdminConfigurationController::class,'showUsers']);

    Route::get('/admin/crear_usuarios', function () {
        return view('/admin/Crear_Usuarios');
    });
    Route::get('/admin/redes_sociales', function () {
        return view('/admin/Redes_Sociales');
    });

    Route::get('/admin/configuraciones', [AdminConfigurationController::class,'index'])->name('configs');

    Route::post('/admin/configuraciones/roulette', [AdminConfigurationController::class,'editRoulette']);
    Route::post('/admin/configuraciones/codes', [AdminConfigurationController::class,'editCodes']);
    Route::post('/admin/configuraciones/polls', [AdminConfigurationController::class,'editPolls']);
    Route::post('/admin/configuraciones/messages', [AdminConfigurationController::class,'editMessages']);

    /* ---- / SUPER USER ---- */

    /* ---- STREAMER ---- */

    Route::get('/streamer', function () {
        return view('/streamer/index');
    });

    // modulo de configuracion para streamer
    Route::get('/streamer/config', [ConfiguracionController::class, 'index']);

    // modulo de codigos para streamer
	Route::get('/streamer/codigos', [CodigoController::class, 'index'])->name('streamer.codigos');
	Route::get('/streamer/getcodigos', [CodigoController::class, 'get_datos'])->name('streamer.getcodigos');

    Route::get('/streamer/message', [MessageController::class, 'index']);
    Route::get('/streamer/roulette', [RouletteController::class, 'index'])->name('streamer.roulette');
    Route::get('/streamer/roulette/getroulette', [RouletteController::class, 'get_roulettes'])->name('streamer.getroulette');
    Route::post('/streamer/roulette/create_roulette', [RouletteController::class, 'createRoulette'])->name('streamer.roulette.createroulette');
    Route::get('/streamer/votaciones', [VotacionesController::class, 'index'])->name('streamer.votaciones');
    Route::get('/streamer/getvotaciones', [VotacionesController::class, 'get_votaciones'])->name('streamer.getvotaciones');
    Route::post('/streamer/votaciones/create_poll', [VotacionesController::class, 'createPoll'])->name('streamer.votaciones.createpoll');

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
// Route::get('/streamer/codigos', [CodigoController::class, 'index'])->name('streamer.codigos');
// Route::get('/streamer/getcodigos', [CodigoController::class, 'get_datos'])->name('streamer.getcodigos');

/* ---- /STREAMER ---- */
/* ---- PUBLIC ROUTES ---- */


/* ---- / PUBLIC ROUTES ---- */


