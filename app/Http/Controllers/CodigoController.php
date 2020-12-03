<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;

class CodigoController extends Controller
{
    public function index(){
        return view('streamer.codigos');
    }

    public function get_datos(Request $request){
    	if ($request->ajax()) {
    		$users = User::query();
        	return DataTables::of($users)->toJson();
    	}
    }
}
