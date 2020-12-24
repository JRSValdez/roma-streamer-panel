<?php

namespace App\Http\Controllers;

use App\Models\SocialNetwork;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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

    public function editStreamerNetworks(Request $request){

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

    public function editStreamerAttributes(Request $request){
        $user = Auth::user();

        $validated = $request->validate([
            'name'=>['string', 'max:30','alpha_dash',Rule::unique(User::class)->ignore($user->id)],
            'email' => [ 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'streamer_user' => [
                'string',
                'max:30',
                'alpha_dash',
                'unique:users,streamer_attributes->user,'.$user->id],
            'img_src' => $request->file('img_src') ? 'mimes:jpg,png,webp,jpeg' : '',
            'logo_image' => 'mimes:jpg,png,webp,jpeg'
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        $streamerAtt = $user->streamer_attributes;
        $streamerAtt->user = $validated['streamer_user'];

        if(isset($validated['img_src'])){
            $imageName = '';
            if($user->img_src != null){
                if($user->img_src != 'default.jpg'){
                    $imageName = $user->img_src;
                } else {
                    $imageName = time() . '.' . $request->img_src->extension();
                }
            }

            $request->file('img_src')->storeAs(
                '/public/user_images/', $imageName
            );

            $user->img_src = $imageName;
        }

        if(isset($validated['logo_image'])){

            $imageName = '';
            if(isset($streamerAtt->logo_image)){
                if($streamerAtt->logo_image != null){
                    if($streamerAtt->logo_image != 'logo_default.png'){
                        $imageName = $streamerAtt->logo_image;
                    } else {
                        $imageName = time() . '.' . $request->logo_image->extension();
                    }
                }
            }

            $request->file('logo_image')->storeAs(
                '/public/user_images/', $imageName
            );

            $streamerAtt->logo_image = $imageName;
        }

        $user->streamer_attributes = $streamerAtt;
        $user->save();

        return redirect()->route('showStreamerConfig');

    }

}
