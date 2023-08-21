<?php

namespace Core\Parents;

use Core\Classes\Illuminate\Application;
use Illuminate\Support\ServiceProvider;

class BaseServiceProvider extends ServiceProvider
{
    /**
     * The application instance.
     * @var Application
     */
    protected $app;
}
