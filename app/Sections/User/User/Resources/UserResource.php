<?php

namespace Sections\User\User\Resources;

use Core\Parents\BaseResource;
use Sections\User\User\Models\User;

class UserResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        /** @var User|null $user */
        $user = $this->resource;
        if (!$user) {
            return [];
        }

        return [
            'id'         => $user->id,
            'name'       => $user->name,
            'email'      => $user->email,
            'role_type'  => $user->role_type,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'deleted_at' => $user->deleted_at,
        ];
    }
}
