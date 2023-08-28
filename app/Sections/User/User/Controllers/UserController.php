<?php

namespace Sections\User\User\Controllers;

use Core\Parents\BaseController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Sections\User\User\Actions\CreateUserAction;
use Sections\User\User\Actions\DeleteUserAction;
use Sections\User\User\Actions\UpdateUserAction;
use Sections\User\User\Models\User;
use Sections\User\User\Requests\CreateUserRequest;
use Sections\User\User\Requests\DeleteUserRequest;
use Sections\User\User\Requests\UpdateUserRequest;
use Sections\User\User\Resources\UserResource;
use Throwable;

class UserController extends BaseController
{
    /**
     * Store a newly created resource in storage.
     */
    public function create(CreateUserRequest $request): UserResource
    {
        $user = $this->action(CreateUserAction::class)->run(
            $request->toDto()
        );
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     * @throws ModelNotFoundException<User>
     */
    public function update(UpdateUserRequest $request): UserResource
    {
        $user = $this->action(UpdateUserAction::class)->run(
            $request->toDto()
        );
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     * @throws ModelNotFoundException<User>
     * @throws Throwable
     */
    public function delete(DeleteUserRequest $request): JsonResponse
    {
        $this->action(DeleteUserAction::class)->run(
            $request->route('id')
        );
        return response()->json();
    }
}
