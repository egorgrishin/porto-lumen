<?php

namespace Core\Parents;

use Core\Classes\Application;
use Illuminate\Support\ServiceProvider;

class BaseServiceProvider extends ServiceProvider
{
    /**
     * The application instance.
     * @var Application
     */
    protected $app;
}
