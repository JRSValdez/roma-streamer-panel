<?php

namespace App\Http\Controllers;

use App\Models\AdminConfiguration;
use App\Models\Poll;
use App\Models\PollAnswers;
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
            $polls = Poll::query()->orderBy('id','desc')->whereNotIn('status',[0]);
            return DataTables::of($polls)->toJson();
        }
    }

    public function createPoll (Request $request){
        $poll = new Poll();
        $participants = AdminConfiguration::query()->select(['polls'])->get()->first();
        $participants = json_decode($participants['polls'],true);
        $user = Auth::user();
        $today_date = date('Y-m-d H:i:s');
        $poll->question = $request->question;
        $poll->participants_number = $participants['max'];
        $poll->entry_date = $today_date ;
        $poll->status = 1;
        $poll->user_id = $user->id;
        if ($poll->save()){
            $answers1 = new PollAnswers();
            $answers1->answer = $request->options[0];
            $answers1->poll_id = $poll->id;
            $answers1->save();
            $answers2 = new PollAnswers();
            $answers2->answer = $request->options[1];
            $answers2->poll_id = $poll->id;
            $answers2->save();
            return redirect()->route('streamer.votaciones');
        }else{
            return redirect()->route('streamer.votaciones');
        }

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

        $roulette->status = 2;

        if ($roulette->update()) {
            $response = 'desactivado';
        }else{
            $response = 'nodesactivado';
        }
        return $response;
    }

    public function delete(Request $request){
        $roulette = Poll::findOrFail($request->id);

        $roulette->status = 0;

        if ($roulette->update()) {
            $response = 'deleted';
        }else{
            $response = 'nodeleted';
        }
        return $response;
    }

    public function pollDetail(Request $request){
//        $roulette = Poll::findOrFail($request->id);
//
//        $roulette->status = 0;
//
//        if ($roulette->update()) {
//            $response = 'deleted';
//        }else{
//            $response = 'nodeleted';
//        }
//        return $response;

    }
}
