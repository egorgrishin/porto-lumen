<?php

namespace Sections\User\User\Tasks;

use Core\Parents\BaseTask;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Sections\User\User\Models\User;

class UserFindOrFailTask extends BaseTask
{
    /**
     * Returns the user by ID
     * @throws ModelNotFoundException<User>
     */
    public function run(int $user_id): User
    {
        /** @var User */
        return User::query()->findOrFail($user_id);
    }
}
