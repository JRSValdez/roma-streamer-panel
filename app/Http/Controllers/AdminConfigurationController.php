<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Models\AdminConfiguration;
use App\Models\Codigo;
use App\Models\Poll;
use App\Models\Roulette;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class AdminConfigurationController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index(){
        $usersCount = User::count();
        $usersDeleted = User::withTrashed()->where('deleted_at','!=',null)->count();

        $rouletteCount = Roulette::count();

        $pollsCount = Poll::count();

        $codesCount = Codigo::count();

        $info = [
            'users_count' => $usersCount,
            'users_deleted_count' => $usersDeleted,
            'roulette_count' => $rouletteCount,
            'polls_count' => $pollsCount,
            'codes_count' => $codesCount,
        ];

        return view('admin.index',$info);
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
            $users = User::query()->withTrashed()->orderBy('id','desc');
            return DataTables::of($users)->toJson();
        }
        return view('/admin/index');
    }

    /**
     * @param Request $request
     * @return bool|int|mixed|null
     */
    public function changeUserStatus(Request $request){
        $validated  = $request->validate([
            'user_id' => 'required|numeric'
        ]);
        try {
            $user = User::withTrashed()->findOrFail($validated['user_id']);

            if($user){
                if($user->deleted_at != null){
                    return $user->restore();
                }
                return $user->delete();
            }
        } catch (\Exception $e) {
            return false;
        }
        return false;
    }

    public function editUser(Request $request){
        $validated  = $request->validate([
            'user_id' => 'required|numeric',
            'name' => ['required', 'string', 'max:30','alpha_dash',Rule::unique(User::class)->ignore($request->user_id)],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($request->user_id),
            ],
        ]);
        try {
            $user = User::withTrashed()->findOrFail($validated['user_id']);

            if($user){
                $user->name = $validated['name'];
                $user->email = $validated['email'];
                $user->save();
                return ['success'=>true];
            }
        } catch (\Exception $e) {
            return ['success'=>false,'message'=>'500, internal server error'];
        }
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
            'site_name' => 'min:3|max:255',
            'site_desc' => 'min:10|max:255',
            'site_img' => 'mimes:png'
        ]);
        $configs = AdminConfiguration::all()->first();
        $configs->site_name = $validated['site_name'];
        $configs->site_desc = $validated['site_desc'];

        $imageName = 'site_logo.png';

        if(isset($validated['site_img'])){
            $request->file('site_img')->storeAs(
                '/public/', $imageName
            );
        }

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
