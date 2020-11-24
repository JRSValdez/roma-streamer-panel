<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CodigoController extends Controller
{
    public function index(Request $request){
    	$data = array();
    	$data[] = array(
                'codigo' => 'asdfgh',
                'premio' => '100 diamantes',
                'max_gans' => '4',
                'estado' => 'activo',
                'fecha_creacion' => '10-10-2020'
            );
    	// json_encode($data);
    	return view('streamer.codigos');
    }
}
