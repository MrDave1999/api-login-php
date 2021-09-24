<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Jwt\IUserToken::class, \App\Jwt\UserToken::class);
        $this->app->bind(\App\Jwt\IPayload::class, \App\Jwt\Payload::class);
        $this->app->bind(\App\Utils\IResponse::class, \App\Utils\Response::class);
        $this->app->bind(\App\Http\Repositories\IUserRepository::class, \App\Http\Repositories\UserRepository::class);
        $this->app->bind(\App\Http\BusinessLayer\IAuth::class, \App\Http\BusinessLayer\Auth::class);
        $this->app->bind(\App\Http\BusinessLayer\IUser::class, \App\Http\BusinessLayer\User::class);
    }
}
