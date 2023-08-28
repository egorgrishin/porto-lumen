<?php

namespace Core\Providers;

use Core\Parents\BaseServiceProvider;
use Illuminate\Database\Migrations\MigrationCreator;
use Sections\User\User\Models\User;
use Sections\User\User\Observers\UserObserver;

class AppServiceProvider extends BaseServiceProvider
{
    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->when(MigrationCreator::class)
            ->needs('$customStubPath')
            ->give(base_path('app/Core/Stubs'));
    }
}
