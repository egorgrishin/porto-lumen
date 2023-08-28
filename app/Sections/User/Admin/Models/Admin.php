<?php

namespace Sections\User\Admin\Models;

use Sections\User\Admin\Data\Factories\AdminFactory;
use Sections\User\User\Models\User;

class Admin extends User
{
    /**
     * The table associated with the model.
     */
    protected $table = 'users';

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): AdminFactory
    {
        return AdminFactory::new();
    }
}
