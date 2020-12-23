<?php

namespace App\Http\Controllers;

use App\Models\Codigo;
use App\Models\Mensaje;
use App\Models\Poll;
use App\Models\Roulette;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StreamerController extends Controller
{
    public function __construct()
    {
        $this->middleware('isStreamer');
    }

    public function index(){
        $user = Auth::user();
        $rouletteCount = Roulette::query()->where("user_id","=",$user->id)->whereNotIn("status",[0])->count();

        $pollsCount = Poll::query()->where("user_id","=",$user->id)->whereNotIn("status",[0])->count();

        $codesCount = Codigo::query()->where("user_id","=",$user->id)->count();

        $messageCount = Mensaje::query()->where("user_id_recibe","=",$user->id)->count();

        $info = [
            'messages_count' => $messageCount,
            'roulette_count' => $rouletteCount,
            'polls_count' => $pollsCount,
            'codes_count' => $codesCount,
        ];
        return view('streamer.index',$info);
    }

    public function switchStatus(Request $request){
        $user = Auth::user();
        $streamerAtt = $user->streamer_attributes;
        if($streamerAtt->live == 'on'){
            $streamerAtt->live = 'off';
        } else{
            $streamerAtt->live = 'on';
        }
        $user->streamer_attributes = $streamerAtt;
        return ['success' => $user->save(), 'status' => $streamerAtt->live];
    }

}
