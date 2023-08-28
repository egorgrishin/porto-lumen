<?php

namespace Core\Parents;

abstract class BaseAction
{
    /**
     * Returns an object of the BaseTask class
     */
    public function task(string $abstract): BaseTask
    {
        return new $abstract;
    }
}
