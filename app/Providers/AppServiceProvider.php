<?php

namespace App\Providers;

use App\Jwt\IPayload;
use App\Jwt\IUserToken;
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
    }
}
