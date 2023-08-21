<?php

namespace Core\Providers;

use Illuminate\Support\ServiceProvider;
use Sections\User\User\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     */
    public function boot(): void
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            return $request->input('api_token')
                ? User::query()->where('api_token', $request->input('api_token'))->first()
                : null;
        });
    }
}
