<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Mensaje;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('isStreamer');
    }

    public function index(){
        return view("/streamer/message");
    }

    public function get_datosM(Request $request){
    	if ($request->ajax()) {
    		$mensajes = Mensaje::query('id_mensaje', 'user_id_envia', 'fecha', 'estado', 'mensaje', 'user_id_recibe')->where('user_id_recibe', auth()->id())->orderBy('id_mensaje', 'desc');
   //  		$grouped = $mensajes->groupBy('user_id_envia');
			// $grouped->all();
        	return DataTables::of($mensajes)->toJson();
    	}
    }
}
