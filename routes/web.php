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
                $view = '/dashboard';
                break;
            default:
                $view = '/user';
                break;
        }

        return redirect($view);
    });

    /* ---- SUPER USER ---- */
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminConfigurationController::class,'index'])->name('adminDashboard');
        Route::get('/usuarios', [AdminConfigurationController::class,'showUsers'])->name('users');
        Route::get('/getUsers', [AdminConfigurationController::class,'getUsers'])->name('getUsers');
        Route::post('/registerAdmin', [AdminConfigurationController::class,'createAdmin'])->name('registerAdmin');
        Route::get('/configuraciones', [AdminConfigurationController::class,'showConfigs'])->name('configs');

        Route::get('/social_networks', [SocialNetworkController::class,'index'])->name('social_networks');
        Route::post('/social_networks/add', [SocialNetworkController::class,'add']);


        Route::post('/configuraciones/roulette', [AdminConfigurationController::class,'editRoulette']);
        Route::post('/configuraciones/codes', [AdminConfigurationController::class,'editCodes']);
        Route::post('/configuraciones/polls', [AdminConfigurationController::class,'editPolls']);
        Route::post('/configuraciones/messages', [AdminConfigurationController::class,'editMessages']);
    });


    /* ---- / SUPER USER ---- */

    /* ---- STREAMER ---- */
    Route::prefix('streamer')->group(function () {
        Route::get('/', [StreamerController::class,'index']);

        // modulo de configuracion para streamer
        Route::get('/config', [ConfiguracionController::class, 'index']);

        // modulo de codigos para streamer
        Route::get('/codigos', [CodigoController::class, 'index'])->name('streamer.codigos');
        Route::post('/getcodigos', [CodigoController::class, 'get_datos'])->name('streamer.getcodigos');
        Route::post('/nuevocodigo', [CodigoController::class, 'crear'])->name('streamer.nuevocodigo');
        Route::post('/activarcodigo', [CodigoController::class, 'activar'])->name('streamer.activarcodigo');
        Route::post('/desactivarcodigo', [CodigoController::class, 'desactivar'])->name('streamer.desactivarcodigo');

        Route::get('/message', [MessageController::class, 'index']);
        Route::get('/roulette', [RouletteController::class, 'index'])->name('streamer.roulette');
        Route::post('/roulette/getroulette', [RouletteController::class, 'get_roulettes'])->name('streamer.getroulette');
        Route::post('/roulette/create_roulette', [RouletteController::class, 'createRoulette'])->name('streamer.roulette.createroulette');
        Route::post('/roulette/activateroulette', [RouletteController::class, 'activate'])->name('streamer.roulette.activateroulette');
        Route::post('/roulette/deactivateroulette', [RouletteController::class, 'deactivate'])->name('streamer.roulette.deactivateroulette');

        Route::get('/votaciones', [VotacionesController::class, 'index'])->name('streamer.votaciones');
        Route::post('/getvotaciones', [VotacionesController::class, 'get_votaciones'])->name('streamer.getvotaciones');
        Route::post('/votaciones/activatevotacion', [VotacionesController::class, 'activate'])->name('streamer.activatevotacion');
        Route::post('/votaciones/deactivatevotacion', [VotacionesController::class, 'deactivate'])->name('streamer.deactivatevotacion');
        Route::post('/votaciones/create_poll', [VotacionesController::class, 'createPoll'])->name('streamer.votaciones.createpoll');

        Route::get('/spin_roulette', function (){
            return view('streamer.spin_roulette');
        });
    });

    /* ---- /STREAMER ---- */

    /* ---- USER ---- */

    Route::prefix('user')->group(function () {
        Route::get('/', [ViewerController::class,'index']);
    });


    /* ---- / USER ---- */

});


/* ---- PUBLIC ROUTES ---- */


/* ---- / PUBLIC ROUTES ---- */


