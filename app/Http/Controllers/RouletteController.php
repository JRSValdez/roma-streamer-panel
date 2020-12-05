<?php

namespace App\Http\Controllers;

use App\Models\Roulette;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class RouletteController extends Controller
{
    //
    public function index(){
        return view("/streamer.roulette");
    }

    public function get_roulettes(Request $request){
        if ($request->ajax()) {
            $polls = Roulette::query();
            return DataTables::of($polls)->addColumn('action', function($row){

                $btn = ' <i onclick="activateSpinWheel('.$row->id.')" class="fa ion-checkmark-round" title="Activar"></i>';
                $btn .= ' <i onclick="deleteVotation('.$row->id.')" class="fa ion-trash-a" title="Eliminar"></i>';
                $btn .= '<i onclick="desactivateVotation('.$row->id.')" class="fa ion-close-round" title="Desactivar"></i>';
                $btn .= '<i onclick="getResults('.$row->id.')" class="fa ion-trophy" title="Ver resultados"></i>';

                return $btn;
            })->rawColumns(['action'])->toJson();
        }
    }

    public function createRoulette (Request $request){
        $roulette = new Roulette();
        $user = Auth::user();
        $roulette->reward = $request->reward;
        $roulette->participants_number = 0;
        $roulette->status = 1;
        $roulette->user_id = $user->id;
        $roulette->save();
        return redirect()->route('streamer.roulette');
    }
}
