<?php

namespace Core\Parents;

use Core\Classes\Illuminate\Application;
use Illuminate\Contracts\Container\BindingResolutionException;

abstract class BaseSubAction
{
    /**
     * Returns an object of the BaseTask class
     */
    public function task(string $abstract): BaseTask
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
