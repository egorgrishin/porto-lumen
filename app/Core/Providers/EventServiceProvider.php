<?php

namespace Core\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     */
    protected $listen = [
        //
    ];

    /**
     * Determine if events and listeners should be automatically discovered.
     * @noinspection PhpUnused
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
