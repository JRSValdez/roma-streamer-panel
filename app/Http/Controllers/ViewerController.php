<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SorteoCodigo;
use App\Models\Codigo;
use App\Models\Mensaje;
use App\Models\SorteoRuleta;
use App\Models\Roulette;
use App\Models\Poll;
use App\Models\PollAnswerDetail;
use App\Models\PollAnswers;
use Illuminate\Support\Facades\DB;

class ViewerController extends Controller
{
    public function __construct()
    {
        $this->middleware('isUser');
    }

    public function index(){
        $streamersDestacados1 = User::query()
            ->select(DB::raw("count(mensaje.id_mensaje) as messages_count,
                                    users.id,
                                    users.name,
                                    users.img_src,
                                    users.streamer_attributes"))
            ->join('mensaje', 'users.id', '=', 'mensaje.user_id_recibe')
            ->where('type',1)
            ->groupBy('users.id', 'users.name', 'users.img_src', "users.streamer_attributes")
            ->limit(4)
            ->orderByDesc('messages_count')
            ->get();

        $idsDestacados = [];

        foreach ($streamersDestacados1 as $destacado){
            $idsDestacados[] = $destacado->id;
        }

        $streamersDestacados2 = User::query()
            ->select(DB::raw("count(mensaje.id_mensaje) as messages_count,
                                    users.id,
                                    users.name,
                                    users.img_src,
                                    users.streamer_attributes"))
            ->leftJoin('mensaje', 'users.id', '=', 'mensaje.user_id_recibe')
            ->where('type',1)
            ->whereNotIn('id',$idsDestacados)
            ->groupBy('users.id', 'users.name', 'users.img_src',"users.streamer_attributes")
            ->limit(6)
            ->orderByDesc('messages_count')
            ->get();

        return view('user.index',['destacados' => $streamersDestacados1, 'streamers' => $streamersDestacados2]);
    }

    public function get_streamer($streamer){
    	$chanel = User::query()->where('name', $streamer)->first();
    	if ($chanel) {
            $logoChanel = $chanel->streamer_attributes->logo_image;
    		$votacion = Poll::query()->where('status', 1)->where('user_id', $chanel->id)->first();
    		if ($votacion) {
    			$votacion_answer = PollAnswers::query()->where('poll_id', $votacion->id)->get();
    			$pull = $votacion->question;
    			$pull_id = $votacion->id;
    		}else{
    			$pull = '';
    			$pull_id = '';
    			$votacion_answer = '';
    		}
    		return view('user.chanel_stream', ['nombre_streamer' => $streamer, 'streamer' => $chanel, 'question' => $pull,'question_id'=>$pull_id, 'vot_ans' => $votacion_answer, 'logo' => $logoChanel]);
    	}else{
    		return redirect("user/");
    	}
    }

    public function canjear_codigo(Request $request){
    	$codigo = new SorteoCodigo();
    	$chanel = User::query()->where('name', $request->streamer)->first();
    	if ($chanel) {
    		$cod = Codigo::select('id_codigo', 'codigo', 'estado')->where('codigo', $request->codigo)->where('user_id', $chanel->id)->get();
	    	$fecha_actual = date('Y-m-d H:i:s');
	    	if (count($cod) > 0) {
                if ($cod[0]->estado == 'a') {
                    $sorteo = SorteoCodigo::where('user_id', auth()->id())->where('codigo_id', $cod[0]->id_codigo)->get();
                    if (count($sorteo) == 0) {
                        if (count($cod) == 1) {
                            $codigo->user_id = auth()->id();
                            $codigo->codigo_id = $cod[0]->id_codigo;
                            $codigo->codigo = $request->codigo;
                            $codigo->id_free_fire = $request->id_free_fire;
                            $codigo->nombre_free_fire = $request->nombre_free_fire;
                            $codigo->servidor = $request->servidor;
                            $codigo->fecha_canjeado = $fecha_actual;
                            if ($codigo->save()) {
                                $response = 'add';
                            }else{
                                $response = 'noadd';
                            }
                        }else{
                            $response = 'noadd';
                        }
                    }else{
                        $response = 'canjeado';
                    }
                }else{
                    $response = 'inactivo';
                }
	    		
	    	}else{
	    		$response = 'noadd';
	    	}
    	}else{
    		$response = 'noadd';
    	}   	

    	return $response;
    }

    public function enviar_mensaje(Request $request){
    	if (strlen($request->mensaje) <= 200) {
    		$mensaje = new Mensaje();
	    	$chanel = User::query()->where('name', $request->streamer)->first();
	    	$fecha_actual = date('Y-m-d H:i:s');

	    	if ($chanel) {
	    		$mensaje->user_id_envia = auth()->id();
		    	$mensaje->user_id_recibe = $chanel->id;
		    	$mensaje->fecha = $fecha_actual;
		    	$mensaje->estado = 'Nuevo';
		    	$mensaje->mensaje = $request->mensaje;

		    	if ($mensaje->save()) {
					$response = 'enviado';
				}else{
					$response = 'noenviado';
				}
	    	}else{
	    		$response = 'noenviado';
	    	}
    	}else{
    		$response = 'maxlenght';
    	}    	

		return $response;
    }

    public function registrar_en_ruleta(Request $request){
    	$sr = new SorteoRuleta();
    	$chanel = User::query()->where('name', $request->streamer)->first();

    	$fecha_actual = date('Y-m-d H:i:s');
    	if ($chanel) {
    		$ruleta = Roulette::query()->where('status', 1)->where('user_id', $chanel->id)->first();

	    	if ($ruleta) {
	    		$rul = SorteoRuleta::where('user_id', auth()->id())->where('ruleta_id', $ruleta->id)->get();
	    		if (count($rul) == 0) {
	    			$sr->user_id = auth()->id();
			    	$sr->ruleta_id = $ruleta->id;
			    	$sr->fecha_canjeado = $fecha_actual;

			    	if ($sr->save()) {
			    		$participantes_number = ($ruleta->participants_number);
			    		$npt = $this->update_participant_roulette($ruleta->id, $participantes_number);
						$response = 'add';
					}else{
						$response = 'noadd';
					}
	    		}else{
	    			$response = 'noadd';
	    		}

	    	}else{
	    		$response = 'noadd-rul';
	    	}
    	}else{
    		$response = 'noadd-rul';
    	}
    	

		return $response;
    }

    public function reg_votacion(Request $request){    
    	$chanel = User::query()->where('name', $request->streamer)->first();	
    	if ($chanel) {
    		$poll_active = Poll::query()->where('status', 1)->where('user_id', $chanel->id)->first();
	    	if ($poll_active) {
	    		$pull = new PollAnswerDetail();
	    		$poll_resp = PollAnswers::join('poll_answers_detail', 'poll_answers.id', '=', 'poll_answers_detail.answer_id')->where('poll_answers.poll_id', $request->qid)->get();
	    		if (count($poll_resp) == 0) {
	    			$sorteopoll = PollAnswerDetail::where('user_id', auth()->id())->where('answer_id', $request->id)->get();
		    		if (count($sorteopoll)==0) {
			    		$pull->user_id = auth()->id();
				    	$pull->answer_id = $request->id;
				    	if ($pull->save()) {
				    		$participantes_number = ($poll_active->participants_number);
				    		$npt = $this->update_participant_pull($poll_active->id, $participantes_number);
				    		$response = 'add';
				    	}else{
				    		$response = 'noadd';
				    	}
			    	}else{
			    		$response = 'noadd';
			    	}
	    		}else{
	    			$response = 'noadd';
	    		}
	    		
	    	}else{
	    		$response = 'noadd-vot';
	    	}
    	}else{
    		$response = 'noadd';
    	}

    	return $response;
    }

    public function update_participant_roulette($id, $np){
    	$ruleta_p = Roulette::findOrFail($id);
    	$nps = ($np + 1);
    	$ruleta_p->participants_number = $nps;

    	return $ruleta_p->update();
    }

    public function update_participant_pull($id, $np){
    	$pull_p = Poll::findOrFail($id);
    	$nps = ($np + 1);
    	$pull_p->participants_number = $nps;

    	return $pull_p->update();
    }
}
