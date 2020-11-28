<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VotacionesController extends Controller
{
    //
    public function index(){
        return view("/streamer/votaciones");
    }
}
