<?php

namespace App\Http\Controllers;

use App\Models\Roulette;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Models\SorteoRuleta;

class RouletteController extends Controller
{
    public function __construct()
    {
        $this->middleware('isStreamer');
    }

    public function index(){
        return view("/streamer.roulette");
    }

    public function get_roulettes(Request $request){
        if ($request->ajax()) {
            $polls = Roulette::query('id','reward','participants_number','status','user_id')->orderBy('id', 'desc');
            return DataTables::of($polls)->toJson();
        }
    }

    public function createRoulette (Request $request){
        $roulette = new Roulette();
        $user = Auth::user();
        $roulette->reward = $request->reward;
        $roulette->participants_number = 0;
        $roulette->status = 1;
        $roulette->user_id = $user->id;
//        if ($roulette->save()) {
//            $response = 'add';
//        }else{
//            $response = 'noadd';
//        }
//        return $response;
        $roulette->save();
        return redirect()->route('streamer.roulette');
    }

    public function activate(Request $request){
        $roulette = Roulette::findOrFail($request->id);

        $roulette->status = 1;

        if ($roulette->update()) {
            $response = 'activado';
        }else{
            $response = 'noactivado';
        }
        return $response;
    }

    public function deactivate(Request $request){
        $roulette = Roulette::findOrFail($request->id);

        $roulette->status = 0;

        if ($roulette->update()) {
            $response = 'desactivado';
        }else{
            $response = 'nodesactivado';
        }
        return $response;
    }

    public function ganadores($id){
        $participantes = SorteoRuleta::query('id_sorteo_ruleta', 'user_id', 'users.name', 'ruleta_id', 'fecha_canjeado')->join('users', 'sorteo_ruleta.user_id', '=', 'users.id')->where('ruleta_id', $id)->orderBy('fecha_canjeado','ASC')->get();
        $total_participantes = count($participantes);
        return view('streamer.spin_roulette', ['id' => $id, 'participantes' => $participantes,
                                                    'total_participantes' => $total_participantes
                                                ]);
    }
}
