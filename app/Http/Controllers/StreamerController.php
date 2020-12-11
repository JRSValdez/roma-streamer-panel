<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StreamerController extends Controller
{
    public function __construct()
    {
        $this->middleware('isStreamer');
    }

    public function index(){
        return view('streamer.index');
    }
}
