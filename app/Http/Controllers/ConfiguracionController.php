<?php

namespace App\Http\Controllers;

use App\Models\SocialNetwork;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfiguracionController extends Controller
{
    public function __construct()
    {
        $this->middleware('isStreamer');
    }

    public function index(){

        $socialNetworks = SocialNetwork::all();
        $streamerNetworks = Auth::user()->streamer_attributes->social_networks;
        $streamerSN = [];
        foreach ($streamerNetworks as $sn){
            $streamerSN[$sn->sn_id] = $sn->url;
        }

    	return view('streamer.configuracion',['social_networks' => $socialNetworks,
                                                    'streamer_networks' => $streamerSN]);
    }

    public function editStreamerAttributes(Request $request){

        $allSocialNetworks = SocialNetwork::all();
        $user =  Auth::user();
        $streamerAtt = $user->streamer_attributes;

        $networksToBeValidated = [];
        $networkValidation = 'required|min:5|max:255';

        foreach ($streamerAtt->social_networks as $sn){
            $networksToBeValidated[ 'sn_'.$sn->sn_id ] = $networkValidation;
        }

        $validated = $request->validate($networksToBeValidated);

        /*editing sn that already exists for the user*/
        foreach($streamerAtt->social_networks as &$sn){
            if( isset( $validated['sn_'.$sn->sn_id] ) ){
                $sn->url = $validated['sn_'.$sn->sn_id];
            }
        }

        /*adding new ones if required*/
        foreach ($allSocialNetworks as $_sn){
            if( !isset( $validated['sn_'.$_sn['id']] ) && $request->has('sn_'.$_sn['id']) ){
                if($request->input('sn_'.$_sn['id']) != null){
                    $newSN = new \stdClass();
                    $newSN->sn_id = $_sn['id'];
                    $newSN->url = $request->input('sn_'.$_sn['id']);
                    $streamerAtt->social_networks[] = $newSN;
                }
            }
        }

        $user->streamer_attributes = $streamerAtt;
        $user->save();
        return redirect()->route('showStreamerConfig');
    }

}
