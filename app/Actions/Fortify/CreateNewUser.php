<?php

namespace App\Actions\Fortify;

use App\Models\SocialNetwork;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return User|string
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:30','alpha_dash','unique:users,name'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'type' => [
                'string',
                'nullable'
            ],
            'streamer_user' => [
                'string',
                'nullable',
                'alpha_dash',
                'unique:users,streamer_attributes->user',
                'max:20',
                'min:3'
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $streamerAttributes = new \stdClass();

        if(!isset($input['type']) && !isset($input['isAdmin'])){
            $streamerAttributes->user = $input['streamer_user'];
            $streamerAttributes->logo_image = 'logo_default.png';
            $streamerAttributes->live = 'off';

            $socialNetworks = $social_networks = SocialNetwork::where('show_in_register','1')->get();
            foreach ($socialNetworks as $sn){
                $newSN = new \stdClass();
                if(isset($input[$sn['id']])){
                    $newSN->sn_id = $sn['id'];
                    $newSN->url = $input[$sn['id']];
                    $streamerAttributes->social_networks[] = $newSN;
                }
            }
        }

        $userType = isset($input['type']) ? ( $input['type'] === 'on' ? 0 : 1 ) : 1; /*0 = user, 1 = streamer*/

        if(isset($input['isAdmin']) && $input['isAdmin'] == 'yes' ){
            $userType = 2; /*admin*/
            User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'type' => $userType,
                'streamer_attributes' => $streamerAttributes,
                'password' => Hash::make($input['password']),
            ]);
            return view('users');
        }

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'type' => $userType,
            'streamer_attributes' => $streamerAttributes,
            'password' => Hash::make($input['password']),
        ]);
    }
}
