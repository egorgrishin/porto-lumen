<?php

/** @var Router $router */
use Laravel\Lumen\Routing\Router;
use Sections\User\Client\Controllers\ClientController;

$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->get('/clients', [ClientController::class, 'get']);
    $router->get('/clients/{id}', [ClientController::class, 'find']);
});
