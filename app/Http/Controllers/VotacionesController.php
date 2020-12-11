<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class VotacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('isStreamer');
    }

    public function index(){
        return view("/streamer.votaciones");
    }
    public function get_votaciones(Request $request){
        if ($request->ajax()) {
            $polls = Poll::query();
            return DataTables::of($polls)->addColumn('action', function($row){

                $btn = ' <i onclick="deleteVotation('.$row->id.')" class="fa ion-trash-a" title="Eliminar"></i>';
                $btn .= '<i onclick="desactivateVotation('.$row->id.')" class="fa ion-close-round" title="Desactivar"></i>';
                $btn .= '<i onclick="getResults('.$row->id.')" class="fa ion-trophy" title="Ver resultados"></i>';

                return $btn;
            })->rawColumns(['action'])->toJson();
        }
    }

    public function createPoll (Request $request){
        $poll = new Poll();
        $user = Auth::user();
        $poll->question = $request->question;
        $poll->participants_number = 0;
        $poll->status = 1;
        $poll->user_id = $user->id;
        $poll->save();
        return redirect()->route('streamer.votaciones');
    }
}
