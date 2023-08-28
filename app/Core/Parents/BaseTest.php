<?php

namespace Core\Parents;

use Laravel\Lumen\Application;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\TestCase;

abstract class BaseTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Creates the application.
     */
    public function createApplication(): Application
    {
        return require __DIR__ . '/../../../bootstrap/app.php';
    }

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }
}
