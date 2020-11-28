<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\User;

class CodigoController extends Controller
{
    public function index(){
    	// if ($request->ajax()) {
            $data = User::query();
            $codigos = datatables()->of($data)->toJson();
     //        // return $data;
     //        return DataTables::of($data)->toJson();

     //        // return datatables()->eloquent($data)->toJson();
     //        // return datatables()->collection($data)->toJson();
     //        // return response()->json($data);
     //    }
        return view('streamer.codigos', ['users'=>$data]);
    	// return view('streamer.codigos', ['users'=>$data]);
    }

    public function get_datos(){
        $codigos = User::select('id', 'name', 'email')->get();
        $json = array();
        $data = json_decode($codigos, true);
        $json['data'][] = datatables()->of($data)->toJson();
        return $json;
        // return datatables()->of($data)->toJson();
        // return datatables()->of($data)->toJson();
        // return DataTables::of($data)->toJson();

        // return datatables()->of(User::query())->toJson();
        // return datatables()->of(DB::table('users'))->toJson();
        // return datatables()->of(User::all())->toJson();

        // return datatables()->eloquent(User::query())->toJson();
        // return datatables()->query(DB::table('users'))->toJson();
        // return datatables()->collection(User::all())->toJson();

        // return datatables(User::query())->toJson();
        // return datatables(DB::table('users'))->toJson();
        // return datatables(User::all())->toJson();
        // return $codigos->toJson(JSON_PRETTY_PRINT);
        // return (string) $codigos;
        // foreach ($data as $objeto) {
        //     $json['data'][] = $objeto;
        // }

        // $jsonstring = json_encode($json, true);
        // var_dump($jsonstring);

        // return datatables()->eloquent($data)->toJson();
        // return datatables()->collection($data)->toJson();
        // return response()->json($data);
    }
}
