<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\AdminConfiguration;
use App\Models\SocialNetwork;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::loginView(function () {
            $config = AdminConfiguration::all()->first()->getSiteInfo();

            return view('auth.login', ['site_name' => $config->site_name]);
        });

        Fortify::registerView(function () {
            $config = AdminConfiguration::all()->first()->getSiteInfo();
            $social_networks = SocialNetwork::where('show_in_register','1')->get();
            return view('auth.register', [
                                                'site_name' => $config->site_name,
                                                'social_networks' => $social_networks
                                                ]);
        });


        Fortify::requestPasswordResetLinkView(function () {
            $config = AdminConfiguration::all()->first()->getSiteInfo();
            $social_networks = SocialNetwork::where('show_in_register','1')->get();
            return view('auth.passwords.email',[
                'site_name' => $config->site_name,
                'social_networks' => $social_networks
            ]);
        });

        Fortify::resetPasswordView(function ($request) {
//            dd($request);
            $config = AdminConfiguration::all()->first()->getSiteInfo();
            $social_networks = SocialNetwork::where('show_in_register','1')->get();
            return view('auth.passwords.reset', [
                'request' => $request,
                'site_name' => $config->site_name,
                'social_networks' => $social_networks
            ]);
        });

    }
}
