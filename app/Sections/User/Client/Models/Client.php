<?php

namespace Sections\User\Client\Models;

use Sections\User\Client\Data\Factories\ClientFactory;
use Sections\User\User\Models\User;

class Client extends User
{
    /**
     * The table associated with the model.
     */
    protected $table = 'users';

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): ClientFactory
    {
        return ClientFactory::new();
    }
}
