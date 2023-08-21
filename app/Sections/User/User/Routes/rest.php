<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->get('/', fn () => dd(config('app')));
