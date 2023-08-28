<?php

namespace Sections\User\User\Actions;

use Core\Parents\BaseAction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Sections\User\User\Dto\CreateUserDto;
use Sections\User\User\Models\User;
use Throwable;

class CreateUserAction extends BaseAction
{
    /**
     * Creates a new user
     */
    public function run(CreateUserDto $dto): ?User
    {
        try {
            return $this->create($dto);
        } catch (Throwable $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * Adds a new user to the database
     */
    public function create(CreateUserDto $dto): User
    {
        return DB::transaction(function () use ($dto) {
            $user = new User();
            $user->name = $dto->name;
            $user->email = $dto->email;
            $user->role = $dto->role;
            $user->password = $dto->password;
            $user->save();
            return $user;
        });
    }
}
