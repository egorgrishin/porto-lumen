<?php

namespace Sections\User\User\Exceptions;

use Core\Parents\BaseException;

class UserNotFoundException extends BaseException
{
    /**
     * Exception Constructor.
     */
    public function __construct(int $user_id)
    {
        parent::__construct("User with ID $user_id not found", 404);
    }
}
