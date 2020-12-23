<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Models\SorteoCodigo;
use App\Models\Codigo;
use App\Models\User;
use App\Models\Mensaje;
=======
use Illuminate\Support\Facades\DB;
>>>>>>> 543e1f06ad9a195a046a49072c0482c9578a7e9a

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
    	$chanel = User::where('name', $streamer)->get();
    	if (count($chanel) == 1) {
    		return view('user.chanel_stream');
    	}else{
    		return redirect('/user/');
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
    	$fecha_actual = date('Y-m-d H:i:s');

    	$mensaje->user_id_envia = auth()->id();
    	$mensaje->user_id_recibe = 1;
    	$mensaje->fecha = $fecha_actual;
    	$mensaje->estado = 'Nuevo';
    	$mensaje->mensaje = $request->mensaje;

    	if ($mensaje->save()) {
			$response = 'enviado';
		}else{
			$response = 'noenviado';
		}
		return $response;
    }
}
