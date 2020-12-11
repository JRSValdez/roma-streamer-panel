<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewerController extends Controller
{
    public function __construct()
    {
        $this->middleware('isUser');
    }

    public function index(){
        return view('user.index');
    }
}
