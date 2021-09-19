<?php

namespace App\Providers;

use App\Http\Repositories\IUserRepository;
use App\Http\Repositories\UserRepository;
use App\Jwt\IPayload;
use App\Jwt\IUserToken;
use App\Utils\IResponse;
use App\Utils\Response;
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
        $this->app->bind(IUserToken::class, UserToken::class);
        $this->app->bind(IPayload::class, Payload::class);
        $this->app->bind(IResponse::class, Response::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
    }
}
