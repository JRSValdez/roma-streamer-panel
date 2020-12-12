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
            $polls = Poll::query()->orderBy('id','desc');
            return DataTables::of($polls)->toJson();
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

    public function activate(Request $request){
        $roulette = Poll::findOrFail($request->id);

        $roulette->status = 1;

        if ($roulette->update()) {
            $response = 'activado';
        }else{
            $response = 'noactivado';
        }
        return $response;
    }

    public function deactivate(Request $request){
        $roulette = Poll::findOrFail($request->id);

        $roulette->status = 0;

        if ($roulette->update()) {
            $response = 'desactivado';
        }else{
            $response = 'nodesactivado';
        }
        return $response;
    }
}
