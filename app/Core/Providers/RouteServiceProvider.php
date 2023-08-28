<?php

namespace Core\Providers;

use Core\Parents\BaseServiceProvider;
use Laravel\Lumen\Routing\Router;

class RouteServiceProvider extends BaseServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->setModuleRoutes();
    }

    /**
     * Defines the routing of modules
     */
    private function setModuleRoutes(): void
    {
        $router = $this->app->router;
        $paths = glob(__DIR__ . '/../../Sections/*/*/Routes/*.php');

        foreach ($paths as $path) {
            $router->group(['prefix' => 'api'], fn (Router $router) => require realpath($path));
        }
    }
}
