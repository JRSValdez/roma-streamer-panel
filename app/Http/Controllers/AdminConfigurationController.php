<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Models\AdminConfiguration;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminConfigurationController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index(){
        return view('admin.index');
    }

    public function showGeneral(){
        $configurations = AdminConfiguration::all()->first();

        return view('admin.general',['configs' => $configurations]);
    }

    public function showConfigs(){
        $configurations = AdminConfiguration::all()->first();

        return view('admin.Configuraciones',['configs' => $configurations->getConfigurations()]);
    }

    public function showUsers(){
        return view('admin.usuarios');
    }

    public function getUsers(Request $request){
        if ($request->ajax()) {
            $users = User::query();
            return DataTables::of($users)
                ->editColumn('type', function($row) {
                    return $row->type == 1 ? 'Streamer' : ($row->type == 3 ? 'Admin' : 'User');
                })
                ->addColumn('action', function($row){
                $btn = '<button class="btn btn-sm btn-danger mr-2"  onclick="deactivateUser('.$row->id.')">
                            Eliminar <i class="fa ion-trash-a" title="Eliminar"></i>
                        </button>';
                $btn .= '<button class="btn btn-sm btn-warning"  onclick="deactivateUser('.$row->id.')">
                            Editar <i class="fa note-icon-pencil" title="Editar"></i>
                        </button>';
                return $btn;
            })->rawColumns(['action'])->toJson();
        }
        return view('/admin/index');
    }

    /**
     * @param Request $request
     * @param App\Actions\Fortify\CreateNewUser $creator
     */
    public function createAdmin(Request $request, CreateNewUser $creator){
        return $creator->create($request->all());
    }

    public function editGeneral(Request $request){
        $validated = $request->validate([
            'site_name' => 'required|min:3|max:255',
            'site_desc' => 'required|min:10|max:255',
            'site_img' => 'required|mimes:jpeg,bmp,png,jpg,webp'
        ]);
        $configs = AdminConfiguration::all()->first();
        $configs->site_name = $validated['site_name'];
        $configs->site_desc = $validated['site_desc'];

        $imageName = 'site_logo'.'.'.$request->site_img->extension();

        $request->file('site_img')->storeAs(
            '/public/', $imageName
        );

        $configs->site_img = $imageName;
        $configs->save();
        return redirect()->route('adminGeneral');
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
