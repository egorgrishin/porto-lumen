<?php

namespace Sections\User\User\Actions;

use Core\Parents\BaseAction;
use Illuminate\Support\Facades\DB;
use Sections\User\User\Dto\UpdateUserDto;
use Sections\User\User\Exceptions\UserNotFoundException;
use Sections\User\User\Models\User;

class UpdateUserAction extends BaseAction
{
    /**
     * Updates the user
     * @throws UserNotFoundException
     */
    public function run(UpdateUserDto $dto): User
    {
        if (!$user = $this->findUser($dto->id)) {
            throw new UserNotFoundException($dto->id);
        }

        return $this->update($user, $dto);
    }

    /**
     * Returns the user by ID
     */
    private function findUser(int $user_id): ?User
    {
        return User::query()->find($user_id);
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
