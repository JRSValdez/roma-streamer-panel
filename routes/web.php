<?php

use App\Http\Controllers\AdminConfigurationController;
use App\Http\Controllers\SocialNetworkController;
use App\Http\Controllers\StreamerController;
use App\Http\Controllers\ViewerController;
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
            case 3:
                $view = '/admin/dashboard';
                break;
            default:
                $view = '/user';
                break;
        }

        return redirect($view);
    });

    /* ---- SUPER USER ---- */

    Route::get('/admin/dashboard', [AdminConfigurationController::class,'index'])->name('adminDashboard');

    Route::get('/admin/usuarios', [AdminConfigurationController::class,'showUsers'])->name('users');
    Route::get('/admin/getUsers', [AdminConfigurationController::class,'getUsers'])->name('getUsers');
    Route::post('/admin/registerAdmin', [AdminConfigurationController::class,'createAdmin'])->name('registerAdmin');
    Route::get('/admin/configuraciones', [AdminConfigurationController::class,'showConfigs'])->name('configs');

    Route::get('/admin/social_networks', [SocialNetworkController::class,'index'])->name('social_networks');
    Route::post('/admin/social_networks/add', [SocialNetworkController::class,'add']);


    Route::post('/admin/configuraciones/roulette', [AdminConfigurationController::class,'editRoulette']);
    Route::post('/admin/configuraciones/codes', [AdminConfigurationController::class,'editCodes']);
    Route::post('/admin/configuraciones/polls', [AdminConfigurationController::class,'editPolls']);
    Route::post('/admin/configuraciones/messages', [AdminConfigurationController::class,'editMessages']);

    /* ---- / SUPER USER ---- */

    /* ---- STREAMER ---- */

    Route::get('/streamer', [StreamerController::class,'index']);

    // modulo de configuracion para streamer
    Route::get('/streamer/config', [ConfiguracionController::class, 'index']);

    // modulo de codigos para streamer
	Route::get('/streamer/codigos', [CodigoController::class, 'index'])->name('streamer.codigos');
	Route::post('/streamer/getcodigos', [CodigoController::class, 'get_datos'])->name('streamer.getcodigos');
	Route::post('/streamer/nuevocodigo', [CodigoController::class, 'crear'])->name('streamer.nuevocodigo');
	Route::post('/streamer/activarcodigo', [CodigoController::class, 'activar'])->name('streamer.activarcodigo');
	Route::post('/streamer/desactivarcodigo', [CodigoController::class, 'desactivar'])->name('streamer.desactivarcodigo');

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

    Route::get('/user', [ViewerController::class,'index']);

    /* ---- / USER ---- */

});


/* ---- / AUTH ROUTES ---- */

// modulo de codigos para streamer
// Route::get('/streamer/codigos', [CodigoController::class, 'index'])->name('streamer.codigos');
// Route::get('/streamer/getcodigos', [CodigoController::class, 'get_datos'])->name('streamer.getcodigos');

/* ---- /STREAMER ---- */
/* ---- PUBLIC ROUTES ---- */


/* ---- / PUBLIC ROUTES ---- */


