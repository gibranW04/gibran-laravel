<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use App\Http\Responses\LoginResponse as CustomLoginResponse;
use App\Http\Responses\RegisterResponse as CustomRegisterResponse;

class FortifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Custom response setelah LOGIN
        $this->app->singleton(
            LoginResponse::class,
            CustomLoginResponse::class
        );

        // Custom response setelah REGISTER
        $this->app->singleton(
            RegisterResponse::class,
            CustomRegisterResponse::class
        );
    }

    public function boot()
    {
        //
    }
}
