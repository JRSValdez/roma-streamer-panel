<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Codigo;
use Yajra\DataTables\DataTables;

class CodigoController extends Controller
{
    public function index(){
        return view('streamer.codigos');
    }

    public function get_datos(Request $request){
    	if ($request->ajax()) {
    		$codigos = Codigo::query('id_codigo', 'codigo', 'premio', 'maximo_ganadores', 'estado', 'fecha_creacion');
        	return DataTables::of($codigos)->toJson();
    	}
    }

    public function crear(Request $request){
    	$codigo = new Codigo();
    	// $codigo = $this->generar(12);
    	// $fecha_actual = new DateTime();

    	$codigo->codigo = 'kokkoko';
    	$codigo->premio = 'swsws';
    	$codigo->maximo_ganadores = '3';
    	$codigo->estado = 'a';
    	$codigo->fecha_creacion = '2020-12-03 01:30:26';
    	// $codigo->user_id = auth()->id();

    	$codigo->create();

    	// return 'add';
    	return view('streamer.codigos');
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
