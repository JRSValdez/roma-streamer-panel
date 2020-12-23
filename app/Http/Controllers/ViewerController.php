<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewerController extends Controller
{
    public function __construct()
    {
        $this->middleware('isUser');
    }

    public function index(){

        $streamersDestacados1 = User::query()
            ->select(DB::raw('count(mensaje.id_mensaje) as messages_count, users.id, users.name, users.img_src'))
            ->join('mensaje', 'users.id', '=', 'mensaje.user_id_recibe')
            ->where('type',1)
            ->groupBy('users.id', 'users.name', 'users.img_src')
            ->limit(4)
            ->orderByDesc('messages_count')
            ->get();

        $streamersDestacados2 = User::query()
            ->select(DB::raw('count(mensaje.id_mensaje) as messages_count, users.id, users.name, users.img_src'))
            ->leftJoin('mensaje', 'users.id', '=', 'mensaje.user_id_recibe')
            ->where('type',1)
            ->groupBy('users.id', 'users.name', 'users.img_src')
            ->offset(4)
            ->limit(6)
            ->orderByDesc('messages_count')
            ->get();

        return view('user.index',['destacados' => $streamersDestacados1, 'streamers' => $streamersDestacados2]);
    }
}
