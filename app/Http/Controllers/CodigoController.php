<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Codigo;
use App\Models\Premio;
use Yajra\DataTables\DataTables;

class CodigoController extends Controller
{
    public function __construct()
    {
        $this->middleware('isStreamer');
    }

    public function index(){
    	$premios = Premio::query('id_premio', 'premio')->get();
        return view('streamer.codigos', ['premios' => $premios]);
    }

    public function get_datos(Request $request){
    	if ($request->ajax()) {
    		$codigos = Codigo::query('id_codigo', 'codigo', 'premio.premio', 'maximo_ganadores', 'elegir_ganador', 'estado', 'fecha_creacion')->where('user_id', auth()->id())->orderBy('id_codigo', 'desc');
        	return DataTables::of($codigos)->toJson();
    	}
    }

    public function crear(Request $request){
    	$codigo = new Codigo();
    	$codigo_generado = $this->generar(12);
    	$fecha_actual = date('Y-m-d H:i:s');

    	$codigo->codigo = $codigo_generado;
    	$codigo->premio = $request->regalo;
    	$codigo->elegir_ganador = $request->ganador;
    	$codigo->maximo_ganadores = $request->max_reclamo;
    	$codigo->estado = 'i';
    	$codigo->fecha_creacion = $fecha_actual;
    	$codigo->user_id = auth()->id();
    	if ($codigo->save()) {
    		$response = 'add';
    	}else{
    		$response = 'noadd';
    	}
    	return $response;
    }

    public function activar(Request $request){
    	$codigo = Codigo::findOrFail($request->id_code);

    	$codigo->estado = 'a';

    	if ($codigo->update()) {
    		$response = 'activado';
    	}else{
    		$response = 'noactivado';
    	}
    	return $response;
    }

    public function desactivar(Request $request){
    	$codigo = Codigo::findOrFail($request->id_code);

    	$codigo->estado = 'i';

    	if ($codigo->update()) {
    		$response = 'desactivado';
    	}else{
    		$response = 'nodesactivado';
    	}
    	return $response;
    }

    public function borrar(Request $request){
    	$codigo = Codigo::findOrFail($request->id_code);

    	if ($codigo->delete()) {
    		$response = 'borrado';
    	}else{
    		$response = 'noborrado';
    	}
    	return $response;
    }

    public function ganadores($id){
    	return view('streamer.ganadorescodigos', ['id' => $id]);
    }

    public function generar($longitud){
        $key = '';
        $patron = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max = strlen($patron)-1;
        for ($i=0; $i < $longitud; $i++) {
            $key .= $patron[mt_rand(0, $max)];
        }
        return $key;
    }
}
