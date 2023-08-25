<?php

namespace Core\Providers;

use Core\Parents\BaseServiceProvider;
use Illuminate\Database\Migrations\MigrationCreator;

class AppServiceProvider extends BaseServiceProvider
{
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
