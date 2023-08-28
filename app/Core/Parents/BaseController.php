<?php

namespace Core\Parents;

abstract class BaseController
{
    /**
     * Returns an object of the BaseAction class
     */
    public function action(string $abstract): BaseAction
    {
        return new $abstract;
    }
}
