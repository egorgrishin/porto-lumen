<?php

namespace Sections\User\User\Actions;

use Core\Parents\BaseAction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Sections\User\User\Dto\UpdateUserDto;
use Sections\User\User\Models\User;
use Sections\User\User\Tasks\UserFindOrFailTask;
use Throwable;

class UpdateUserAction extends BaseAction
{
    /**
     * Updates the user
     * @throws ModelNotFoundException<User>
     * @throws Throwable
     */
    public function run(UpdateUserDto $dto): User
    {
        return $this->update(
            $this->task(UserFindOrFailTask::class)->run($dto->id), $dto
        );
    }

    /**
     * Changes the user in the database
     * @throws Throwable
     */
    public function update(User $user, UpdateUserDto $dto): User
    {
        if ($dto->name) {
            $user->name = $dto->name;
        }
        if ($dto->email) {
            $user->email = $dto->email;
        }
        if ($dto->role) {
            $user->role = $dto->role;
        }
        if ($dto->password) {
            $user->password = $dto->password;
        }
        $user->saveOrFail();
        return $user;
    }
}
