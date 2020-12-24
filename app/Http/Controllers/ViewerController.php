<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SorteoCodigo;
use App\Models\Codigo;
use App\Models\Mensaje;
use App\Models\SorteoRuleta;
use App\Models\Roulette;
use Illuminate\Support\Facades\DB;

class ViewerController extends Controller
{
    public function __construct()
    {
        $this->middleware('isUser');
    }

    public function index(){

        $streamersDestacados1 = User::query()
            ->select(DB::raw('count(mensaje.id_mensaje) as messages_count, users.id, users.name, users.img_src'))
            ->join('mensaje', 'users.id', '=', 'mensaje.user_id_recibe')
            ->where('type',1)
            ->groupBy('users.id', 'users.name', 'users.img_src')
            ->limit(4)
            ->orderByDesc('messages_count')
            ->get();

        $streamersDestacados2 = User::query()
            ->select(DB::raw('count(mensaje.id_mensaje) as messages_count, users.id, users.name, users.img_src'))
            ->leftJoin('mensaje', 'users.id', '=', 'mensaje.user_id_recibe')
            ->where('type',1)
            ->groupBy('users.id', 'users.name', 'users.img_src')
            ->offset(4)
            ->limit(6)
            ->orderByDesc('messages_count')
            ->get();

        return view('user.index',['destacados' => $streamersDestacados1, 'streamers' => $streamersDestacados2]);
    }

    public function get_streamer($streamer){
    	$chanel = User::query()->where('name', $streamer)->first();
    	if ($chanel) {
    		return view('user.chanel_stream', ['nombre_streamer' => $streamer, 'streamer' => $chanel]);
    	}else{
    		return redirect("user/");
    	}

    }

    public function canjear_codigo(Request $request){
    	$codigo = new SorteoCodigo();
    	$cod = Codigo::select('id_codigo', 'codigo')->where('codigo', $request->codigo)->get();
    	$fecha_actual = date('Y-m-d H:i:s');
    	if (count($cod) > 0) {
    		$sorteo = SorteoCodigo::where('user_id', auth()->id())->where('codigo_id', $cod[0]->id_codigo)->get();
    		if (count($sorteo) == 0) {
	    		if (count($cod) == 1) {
		    		$codigo->user_id = auth()->id();
			    	$codigo->codigo_id = $cod[0]->id_codigo;
			    	$codigo->codigo = $request->codigo;
			    	$codigo->id_free_fire = $request->id_free_fire;
			    	$codigo->nombre_free_fire = $request->nombre_free_fire;
			    	$codigo->servidor = $request->servidor;
			    	$codigo->fecha_canjeado = $fecha_actual;
			    	if ($codigo->save()) {
			    		$response = 'add';
			    	}else{
			    		$response = 'noadd';
			    	}
		    	}else{
		    		$response = 'noadd';
		    	}
	    	}else{
	    		$response = 'canjeado';
	    	}
    	}else{
    		$response = 'noadd';
    	}

    	return $response;
    }

    public function enviar_mensaje(Request $request){
    	$mensaje = new Mensaje();
    	$chanel = User::query()->where('name', $request->streamer)->first();
    	$fecha_actual = date('Y-m-d H:i:s');

    	if ($chanel) {
    		$mensaje->user_id_envia = auth()->id();
	    	$mensaje->user_id_recibe = $chanel->id;
	    	$mensaje->fecha = $fecha_actual;
	    	$mensaje->estado = 'Nuevo';
	    	$mensaje->mensaje = $request->mensaje;

	    	if ($mensaje->save()) {
				$response = 'enviado';
			}else{
				$response = 'noenviado';
			}
    	}else{
    		$response = 'noenviado';
    	}

		return $response;
    }

    public function registrar_en_ruleta(){
    	$sr = new SorteoRuleta();
    	
    	$fecha_actual = date('Y-m-d H:i:s');
    	$ruleta = Roulette::query()->where('status', 1)->first();
    	$participantes_number = ($ruleta->participants_number);
    	if ($ruleta) {
    		$rul = SorteoRuleta::where('user_id', auth()->id())->where('ruleta_id', $ruleta->id)->get();
    		if (count($rul) == 0) {    			
    			$sr->user_id = auth()->id();
		    	$sr->ruleta_id = $ruleta->id;
		    	$sr->fecha_canjeado = $fecha_actual;

		    	if ($sr->save()) {
		    		$npt = $this->update_participant_roulette($ruleta->id, $participantes_number);
					$response = 'add';
				}else{
					$response = 'noadd';
				}
    		}else{
    			$response = 'noadd';
    		}

    	}else{
    		$response = 'noadd-rul';
    	}

		return $response;
    }

    public function update_participant_roulette($id, $np){
    	$ruleta_p = Roulette::findOrFail($id);
    	$nps = ($np + 1);
    	$ruleta_p->participants_number = $nps;

    	return $ruleta_p->update();
    }
}
