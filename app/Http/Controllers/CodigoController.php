<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\User;

class CodigoController extends Controller
{
    public function index(Request $request){
    	if ($request->ajax()) {
            $data = User::query();
            // return $data;
            // return DataTables::of($data)->toJson();

            // return datatables()->eloquent($data)->toJson();
            // return datatables()->collection($data)->toJson();
            // return response()->json($data);
        }
        return view('streamer.codigos');
    	// return view('streamer.codigos', ['users'=>$data]);
    }
}
