<?php

namespace App\Http\Controllers;

use App\Models\Codigo;
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
        $rouletteCount = Roulette::query()->where("user_id","=",$user->id)->count();

        $pollsCount = Poll::query()->where("user_id","=",$user->id)->whereNotIn("status",[0])->count();

        $codesCount = Codigo::query()->where("user_id","=",$user->id)->count();

        $messageCount = 0;

        $info = [
            'messages_count' => $messageCount,
            'roulette_count' => $rouletteCount,
            'polls_count' => $pollsCount,
            'codes_count' => $codesCount,
        ];
        return view('streamer.index',$info);
    }
}
