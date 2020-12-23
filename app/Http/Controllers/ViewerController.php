<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SorteoCodigo;
use App\Models\Codigo;
use App\Models\User;
use App\Models\Mensaje;

class ViewerController extends Controller
{
    public function __construct()
    {
        $this->middleware('isUser');
    }

    public function index(){
        return view('user.index');
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
