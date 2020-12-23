<?php

namespace App\Http\Controllers;

use App\Models\AdminConfiguration;
use App\Models\Roulette;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Models\SorteoRuleta;

class RouletteController extends Controller
{
    public function __construct()
    {
        $this->middleware('isStreamer');
    }

    public function index(){
        return view("/streamer.roulette");
    }

    public function registrarRuleta(Request $request){
        $validated = $request->validate([
            'user_id'=>['required','numeric'],
            'ruleta_id' => ['required','numeric']
        ]);

        return PollAnswerDetail::create([
            'user_id' => $validated['user_id'],
            'ruleta_id' => $validated['ruleta_id']
        ]);
    }

    public function get_roulettes(Request $request){
        if ($request->ajax()) {
            $polls = Roulette::query('id','reward','participants_number','status','user_id')->where('user_id','=',Auth::id())->orderBy('id', 'desc')->whereNotIn('status',[0]);
            return DataTables::of($polls)->toJson();
        }
    }

    public function createRoulette (Request $request){

        $pollNumber = Roulette::query()->whereDate('entry_date', "=", Carbon::now()->format('Y-m-d'))->whereNotIn('status',[0])->whereIn("user_id",[Auth::id()])->count();
        $maxPerDay = AdminConfiguration::query()->select(['roulette'])->get()->first();
        $maxPerDay = json_decode($maxPerDay['roulette'],true);
        if ($maxPerDay['max_per_day'] <= $pollNumber) return 'noadd';

        $rouletteActive = Roulette::query()->where('status', "=", 1)->whereIn("user_id",[Auth::id()])->count();
        if ($rouletteActive > 0) return 'noaddactive';

        $roulette = new Roulette();
        $today_date = date('Y-m-d H:i:s');
        $user = Auth::user();
        $roulette->reward = $request->reward;
        $roulette->participants_number = 0;
        $roulette->entry_date = $today_date;
        $roulette->status = 1;
        $roulette->user_id = $user->id;
        if ($roulette->save()) {
            $response = 'add';
        }else{
            $response = 'noadd';
        }
        return $response;
    }

    public function activate(Request $request){

        $rouletteActive = Roulette::query()->where('status', "=", 1)->whereNotIn('id',[$request->id])->whereIn("user_id",[Auth::id()])->count();
        if ($rouletteActive > 0) return 'noaddactive';

        $roulette = Roulette::findOrFail($request->id);

        $roulette->status = 1;

        if ($roulette->update()) {
            $response = 'activado';
        }else{
            $response = 'noactivado';
        }
        return $response;
    }

    public function deactivate(Request $request){
        $roulette = Roulette::findOrFail($request->id);

        $roulette->status = 2;

        if ($roulette->update()) {
            $response = 'desactivado';
        }else{
            $response = 'nodesactivado';
        }
        return $response;
    }

    public function ganadores($id){
        $participantes = SorteoRuleta::query('id_sorteo_ruleta', 'user_id', 'users.name', 'ruleta_id', 'fecha_canjeado')->join('users', 'sorteo_ruleta.user_id', '=', 'users.id')->where('ruleta_id', $id)->orderBy('fecha_canjeado','ASC')->get();
        $total_participantes = count($participantes);
        return view('streamer.spin_roulette', ['id' => $id, 'participantes' => $participantes,
                                                    'total_participantes' => $total_participantes
                                                ]);
    }
    public function delete(Request $request){
        $roulette = Roulette::findOrFail($request->id);

        $roulette->status = 0;

        if ($roulette->update()) {
            $response = 'deleted';
        }else{
            $response = 'nodeleted';
        }
        return $response;
    }

}
