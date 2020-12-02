<?php

namespace App\Http\Controllers;

use App\Models\AdminConfiguration;
use App\Models\User;
use Illuminate\Http\Request;

class AdminConfigurationController extends Controller
{
    public function index(){
        $configurations = AdminConfiguration::all()->first();

        return view('admin.Configuraciones',['configs' => $configurations->getConfigurations()]);
    }

    public function showUsers(){
        $users = User::paginate(2);
        return view('admin.usuarios',['users' => $users]);
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

    public function editCodes(Request $request){
        $validated = $request->validate([
            'max_codes' => 'required|min:1|max:10000|numeric',
            'max_per_codes' => 'required|min:1|max:50|numeric',
        ]);
        $configs = AdminConfiguration::all()->first();
        $configs->codes =
            json_encode([
                'max' => $validated['max_codes'],
                'max_per_day' => $validated['max_per_codes']
            ]);
        $configs->save();
        return redirect()->route('configs');
    }

    public function editPolls(Request $request){
        $validated = $request->validate([
            'max_polls' => 'required|min:1|max:10000|numeric',
            'max_per_polls' => 'required|min:1|max:50|numeric',
        ]);
        $configs = AdminConfiguration::all()->first();
        $configs->polls =
            json_encode([
                'max' => $validated['max_polls'],
                'max_per_day' => $validated['max_per_polls']
            ]);
        $configs->save();
        return redirect()->route('configs');
    }

    public function editMessages(Request $request){
        $validated = $request->validate([
            'max_messages' => 'required|min:1|max:10000|numeric',
            'max_per_msg' => 'required|min:1|max:50|numeric',
        ]);
        $configs = AdminConfiguration::all()->first();
        $configs->messages =
            json_encode([
                'max' => $validated['max_messages'],
                'max_per_day' => $validated['max_per_msg']
            ]);
        $configs->save();
        return redirect()->route('configs');
    }

}
