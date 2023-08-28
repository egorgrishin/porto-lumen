<?php

/** @var Router $router */
use Laravel\Lumen\Routing\Router;
use Sections\User\User\Controllers\UserController;

$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->post('/users', [UserController::class, 'create']);
    $router->patch('/users/{id}', [UserController::class, 'update']);
    $router->delete('/users/{id}', [UserController::class, 'delete']);
});
