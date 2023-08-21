<?php

namespace Core\Providers;

use Core\Parents\BaseServiceProvider;

class DatabaseServiceProvider extends BaseServiceProvider
{
    /**
     * Boot the database services for the application.
     */
    public function boot(): void
    {
        $this->setMigrationsDirs();
    }

    /**
     * Defines migration directories
     */
    private function setMigrationsDirs(): void
    {
        $paths = glob(__DIR__ . '/../../Sections/*/*/Data/Migrations');
        $this->loadMigrationsFrom($paths);
    }
}
