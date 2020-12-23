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

    public function nuevoMensaje(Request $request){
        $validated = $request->validate([
            'mensaje'=>['required','max:200'],
            'to_id' => ['required','numeric'],
            'from_id' => ['required','numeric']
        ]);

        return Mensaje::create([
            'mensaje' => $validated['mensaje'],
            'user_id_envia' => $validated['from_id'],
            'user_id_recibe' => $validated['to_id'],
            'fecha' => now(),
            'estado' => 1
        ]);
    }

    public function get_datosM(Request $request){
    	if ($request->ajax()) {
    		$mensajes = Mensaje::query('id_mensaje', 'user_id_envia', 'fecha', 'estado', 'mensaje', 'user_id_recibe', 'users.name')->join('users', 'mensaje.user_id_envia', '=', 'users.id')->where('user_id_recibe', auth()->id())->orderBy('id_mensaje', 'desc');
        	return DataTables::of($mensajes)->toJson();
    	}
    }
}
