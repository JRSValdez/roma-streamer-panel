<?php

namespace App\Actions\Fortify;

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
     * @return \App\Models\User
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
            'sn_1' => [
                'string',
                'nullable',
                'max:260'
            ],
            'sn_2' => [
                'string',
                'nullable',
                'max:260'
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $streamerAttributes = new \stdClass();
        if(!isset($input['type'])){
            $streamerAttributes->user = $input['streamer_user'];
            $streamerAttributes->facebook_url = $input['sn_1'];
            $streamerAttributes->youtube_url = $input['sn_2'];
        }

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'type' => isset($input['type']) ? ( $input['type'] === 'on' ? 0 : 1 ) : 1, /*0 = user, 1 = streamer*/
            'streamer_attributes' => $streamerAttributes,
            'password' => Hash::make($input['password']),
        ]);
    }
}
