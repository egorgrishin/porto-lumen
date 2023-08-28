<?php

namespace Sections\User\User\Actions;

use Core\Parents\BaseAction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Sections\User\User\Dto\UpdateUserDto;
use Sections\User\User\Models\User;
use Sections\User\User\Tasks\UserFindOrFailTask;

class UpdateUserAction extends BaseAction
{
    /**
     * Updates the user
     * @throws ModelNotFoundException<User>
     */
    public function run(UpdateUserDto $dto): User
    {
        return $this->update(
            $this->task(UserFindOrFailTask::class)->run($dto->id), $dto
        );
    }

    /**
     * Changes the user in the database
     */
    public function update(User $user, UpdateUserDto $dto): User
    {
        return DB::transaction(function () use ($user, $dto) {
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
            $user->save();
            return $user;
        });
    }
}
