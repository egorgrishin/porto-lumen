<?php

namespace Core\Parents;

use Laravel\Lumen\Application;
use Laravel\Lumen\Testing\TestCase;

abstract class BaseTest extends TestCase
{
    /**
     * Creates the application.
     */
    public function createApplication(): Application
    {
        return require __DIR__ . '/../../../bootstrap/app.php';
    }
}
