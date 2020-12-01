<?php

namespace App\Http\Controllers;

use App\Models\AdminConfiguration;
use Illuminate\Http\Request;

class AdminConfigurationController extends Controller
{
    public function index(){
        $configurations = AdminConfiguration::all()->first();
        $configurations->roulette = json_decode($configurations->roulette,true);
        $configurations->polls = json_decode($configurations->polls,true);
        $configurations->codes = json_decode($configurations->codes,true);
        $configurations->messages = json_decode($configurations->messages,true);

        return view('admin.Configuraciones',['configs' => $configurations]);
    }

    public function editRoulette(Request $request){
        $validated = $request->validate([
            'max_roulette' => 'required|min:1|max:10000|numeric',
            'max_per_roulette' => 'required|min:1|max:50|numeric',
        ]);
        $configs = AdminConfiguration::all()->first();
        $configs->roulette =
            json_encode([
                'max' => $validated['max_roulette'],
                'max_per_day' => $validated['max_per_roulette']
            ]);
        $configs->save();
        return redirect()->route('configs');
    }
}
