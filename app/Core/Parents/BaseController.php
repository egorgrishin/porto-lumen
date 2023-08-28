<?php

namespace Core\Parents;

use Core\Classes\Illuminate\Application;
use Illuminate\Contracts\Container\BindingResolutionException;

abstract class BaseController
{
    /**
     * Returns an object of the BaseAction class
     */
    public function action(string $abstract): BaseAction
    {
        try {
            return new $abstract(
                ...Application::getInstance()->getResolvedDependencies($abstract)
            );
        } catch (BindingResolutionException) {
            return new $abstract;
        }
    }
}
