<?php

namespace Core\Classes\Illuminate;

use Laravel\Lumen\Application as LumenApplication;
use Laravel\Lumen\Routing\Router;

class Application extends LumenApplication
{
    /**
     * The Router instance.
     * @var Router
     */
    public $router;
}
