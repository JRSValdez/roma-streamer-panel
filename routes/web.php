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
            case 2:
                $view = '/admin/dashboard';
                break;
            default:
                $view = '/user/streamers';
                break;
        }

        return redirect($view);
    });

    /* ---- SUPER USER ---- */
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminConfigurationController::class,'index'])->name('adminDashboard');

        /*General*/
        Route::get('/general', [AdminConfigurationController::class,'showGeneral'])->name('adminGeneral');
        Route::post('/general/edit', [AdminConfigurationController::class,'editGeneral'])->name('editGeneral');

        /*configs*/
        Route::get('/configuraciones', [AdminConfigurationController::class,'showConfigs'])->name('configs');
        Route::post('/configuraciones/roulette', [AdminConfigurationController::class,'editRoulette']);
        Route::post('/configuraciones/codes', [AdminConfigurationController::class,'editCodes']);
        Route::post('/configuraciones/polls', [AdminConfigurationController::class,'editPolls']);
        Route::post('/configuraciones/messages', [AdminConfigurationController::class,'editMessages']);

        /*users*/
        Route::get('/usuarios', [AdminConfigurationController::class,'showUsers'])->name('users');
        Route::post('/getUsers', [AdminConfigurationController::class,'getUsers'])->name('getUsers');
        Route::post('/registerAdmin', [AdminConfigurationController::class,'createAdmin'])->name('registerAdmin');
        Route::post('/usuarios/changeUserStatus', [AdminConfigurationController::class,'changeUserStatus'])->name('changeUserStatus');
        Route::post('/usuarios/editUser', [AdminConfigurationController::class,'editUser'])->name('editUser');

        /*social networks*/
        Route::get('/social_networks', [SocialNetworkController::class,'index'])->name('social_networks');
        Route::post('/getSocialNetworks', [SocialNetworkController::class,'getSocialNetworks'])->name('getSocialNetworks');
        Route::post('/social_networks/changeShow', [SocialNetworkController::class,'changeShow'])->name('snChangeShow');
        Route::post('/social_networks/changeStatus', [SocialNetworkController::class,'changeStatus'])->name('snChangeStatus');
        Route::post('/social_networks/add', [SocialNetworkController::class,'add']);
        Route::post('/social_networks/edit', [SocialNetworkController::class,'edit'])->name('editSN');

    });


    /* ---- / SUPER USER ---- */

    /* ---- STREAMER ---- */
    Route::prefix('streamer')->group(function () {
        Route::get('/', [StreamerController::class,'index'])->name('streamer.dashboard');
        Route::post('/switchStatus', [StreamerController::class,'switchStatus'])->name('switchStatus');

        // modulo de configuracion para streamer
        Route::get('/config', [ConfiguracionController::class, 'index'])->name('showStreamerConfig');
        Route::post('/config/urls', [ConfiguracionController::class, 'editStreamerNetworks'])->name('editStreamerUrls');
        Route::post('/config/attributes', [ConfiguracionController::class, 'editStreamerAttributes'])->name('editStreamer');

        // modulo de codigos para streamer
        Route::get('/codigos', [CodigoController::class, 'index'])->name('streamer.codigos');
        Route::post('/getcodigos', [CodigoController::class, 'get_datos'])->name('streamer.getcodigos');
        Route::post('/getmensajes', [MessageController::class, 'get_datosM'])->name('streamer.getmensajes');
        Route::post('/nuevocodigo', [CodigoController::class, 'crear'])->name('streamer.nuevocodigo');
        Route::post('/activarcodigo', [CodigoController::class, 'activar'])->name('streamer.activarcodigo');
        Route::post('/desactivarcodigo', [CodigoController::class, 'desactivar'])->name('streamer.desactivarcodigo');
        Route::post('/borrarcodigo', [CodigoController::class, 'borrar'])->name('streamer.borrarcodigo');
        Route::get('/codigos/ganadores/{id}', [CodigoController::class, 'ganadores'])->name('streamer.ganadores');
        Route::post('/codigos/registrarse', [CodigoController::class, 'registrarCodigo'])->name('streamer.registrarse');

        Route::get('/message', [MessageController::class, 'index'])->name('streamer.messages');
        Route::get('/roulette', [RouletteController::class, 'index'])->name('streamer.roulette');
        Route::post('/roulette/getroulette', [RouletteController::class, 'get_roulettes'])->name('streamer.getroulette');
        Route::post('/roulette/create_roulette', [RouletteController::class, 'createRoulette'])->name('streamer.roulette.createroulette');
        Route::post('/roulette/activateroulette', [RouletteController::class, 'activate'])->name('streamer.roulette.activateroulette');
        Route::post('/roulette/deactivateroulette', [RouletteController::class, 'deactivate'])->name('streamer.roulette.deactivateroulette');
        Route::post('/roulette/deleteroulette', [RouletteController::class, 'delete'])->name('streamer.roulette.deleteroulette');
        Route::get('/ruleta/ganadores/{id}', [RouletteController::class, 'ganadores'])->name('streamer.ganadores.ruleta');
        Route::get('/ruleta/registrarse', [RouletteController::class, 'registrarRuleta'])->name('streamer.ganadores.registrarse');

        Route::get('/votaciones', [VotacionesController::class, 'index'])->name('streamer.votaciones');
        Route::post('/getvotaciones', [VotacionesController::class, 'get_votaciones'])->name('streamer.getvotaciones');
        Route::post('/votaciones/activatevotacion', [VotacionesController::class, 'activate'])->name('streamer.activatevotacion');
        Route::post('/votaciones/deactivatevotacion', [VotacionesController::class, 'deactivate'])->name('streamer.deactivatevotacion');
        Route::post('/votaciones/deletevotacion', [VotacionesController::class, 'delete'])->name('streamer.deletevotacion');
        Route::post('/votaciones/create_poll', [VotacionesController::class, 'createPoll'])->name('streamer.votaciones.createpoll');
        Route::post('/votaciones/getanswerdetail', [VotacionesController::class, 'pollDetail'])->name('streamer.votaciones.getanswerdetail');

        Route::get('/spin_roulette', function (){
            return view('streamer.spin_roulette');
        });
    });

    /* ---- /STREAMER ---- */

    /* ---- USER ---- */

    Route::prefix('user')->group(function () {
        Route::get('/streamers', [ViewerController::class, 'index'])->name('showStreamers');
        Route::get('/chanel/{streamer}', [ViewerController::class, 'get_streamer']);
        Route::post('/canjearcodigo', [ViewerController::class, 'canjear_codigo'])->name('user.canjearcodigo');
        Route::post('/registrarvotacion', [ViewerController::class, 'reg_votacion'])->name('user.registrarvotacion');
        Route::post('/mensaje', [ViewerController::class, 'enviar_mensaje'])->name('user.mensaje');
        Route::post('/ruleta', [ViewerController::class, 'registrar_en_ruleta'])->name('user.ruleta');
    });


    /* ---- / USER ---- */

});


/* ---- PUBLIC ROUTES ---- */


/* ---- / PUBLIC ROUTES ---- */


