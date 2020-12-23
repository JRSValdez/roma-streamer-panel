<?php

namespace App\Http\Controllers;

use App\Models\AdminConfiguration;
use App\Models\Poll;
use App\Models\PollAnswerDetail;
use App\Models\PollAnswers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use function MongoDB\Driver\Monitoring\removeSubscriber;

class VotacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('isStreamer');
    }

    public function index(){
        return view("/streamer.votaciones");
    }

    public function votar(Request $request){
        $validated = $request->validate([
            'user_id'=>['required','numeric'],
            'answer_id' => ['required','numeric']
        ]);

        return PollAnswerDetail::create([
            'user_id' => $validated['mensaje'],
            'answer_id' => $validated['from_id']
        ]);
    }

    public function get_votaciones(Request $request){
        if ($request->ajax()) {
            $polls = Poll::query()->where('user_id','=',Auth::id())->orderBy('id','desc')->whereNotIn('status',[0]);
            return DataTables::of($polls)->toJson();
        }
    }

    public function createPoll (Request $request){
        $pollNumber = Poll::query()->whereDate('entry_date', "=", Carbon::now()->format('Y-m-d'))->whereNotIn('status',[0])->whereIn("user_id",[Auth::id()])->count();
        $maxPerDay = AdminConfiguration::query()->select(['polls'])->get()->first();
        $maxPerDay = json_decode($maxPerDay['polls'],true);
        if ($maxPerDay['max_per_day'] <= $pollNumber) return 'noadd';

        $pollActive = Poll::query()->where('status', "=", 1)->whereIn("user_id",[Auth::id()])->count();
        if ($pollActive > 0) return 'noaddactive';

        $poll = new Poll();
        $today_date = date('Y-m-d H:i:s');
        $user = Auth::user();
        $poll->question = $request->question;
        $poll->participants_number = 0;
        $poll->entry_date = $today_date ;
        $poll->status = 1;
        $poll->user_id = $user->id;
        if ($poll->save()){
            $answers1 = new PollAnswers();
            $answers1->answer = $request->option1;
            $answers1->poll_id = $poll->id;
            $answers1->save();
            $answers2 = new PollAnswers();
            $answers2->answer = $request->option2;
            $answers2->poll_id = $poll->id;
            $answers2->save();
            return 'add';
        }else{
            return 'noadd';
        }

    }

    public function activate(Request $request){

        $pollActive = Poll::query()->where('status', "=", 1)->whereNotIn('id',[$request->id])->whereIn("user_id",[Auth::id()])->count();
        if ($pollActive > 0) return 'noaddactive';

        $poll = Poll::findOrFail($request->id);

        $poll->status = 1;

        if ($poll->update()) {
            $response = 'activado';
        }else{
            $response = 'noactivado';
        }
        return $response;
    }

    public function deactivate(Request $request){
        $poll = Poll::findOrFail($request->id);

        $poll->status = 2;

        if ($poll->update()) {
            $response = 'desactivado';
        }else{
            $response = 'nodesactivado';
        }
        return $response;
    }

    public function delete(Request $request){
        $poll = Poll::findOrFail($request->id);

        $poll->status = 0;

        if ($poll->update()) {
            $response = 'deleted';
        }else{
            $response = 'nodeleted';
        }
        return $response;
    }

    public function pollDetail(Request $request){
        $answer = PollAnswers::query()->selectRaw("poll_answers.answer, count(poll_answers_detail.answer_id) as total_answer_detail")
            ->leftJoin("poll_answers_detail","poll_answers.id","=","poll_answers_detail.answer_id")
            ->where('poll_id','=',[$request->id])
            ->groupBy("poll_answers.answer", "poll_answers.id")
            ->orderBy("poll_answers.id","asc")
            ->get();
        return $answer;

    }
}
