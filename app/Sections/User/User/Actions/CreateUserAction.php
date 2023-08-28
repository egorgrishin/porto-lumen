<?php

namespace Sections\User\User\Actions;

use Core\Parents\BaseAction;
use Sections\User\User\Dto\CreateUserDto;
use Sections\User\User\Models\User;
use Throwable;

class CreateUserAction extends BaseAction
{
    /**
     * Creates a new user
     * @throws Throwable
     */
    public function run(CreateUserDto $dto): User
    {
        $user = new User();
        $user->name = $dto->name;
        $user->email = $dto->email;
        $user->role_type = $dto->role_type;
        $user->password = $dto->password;
        $user->saveOrFail();
        return $user;
    }
}
