<?php

namespace Sections\User\User\Actions;

use Core\Parents\BaseAction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Sections\User\User\Models\User;
use Sections\User\User\Tasks\UserFindOrFailTask;
use Throwable;

class DeleteUserAction extends BaseAction
{
    /**
     * Deletes a user by ID
     * @throws ModelNotFoundException<User>
     * @throws Throwable
     */
    public function run(int $user_id): void
    {
        $this->task(UserFindOrFailTask::class)
            ->run($user_id)
            ->deleteOrFail();
    }
}
