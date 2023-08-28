<?php

namespace Sections\User\User\Requests;

use Core\Parents\BaseRequest;
use Sections\User\Role\Models\Role;
use Sections\User\User\Dto\CreateUserDto;
use Sections\User\User\Models\User;

class CreateUserRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return (bool) $this->user()?->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $user = User::class;
        $role = Role::class;
        return [
            'name'      => 'required|string|max:255',
            'email'     => "required|email|unique:$user|max:255",
            'role_type' => "required|string|exists:$role,type|max:30",
            'password'  => "required|string",
        ];
    }

    /**
     * Returns the DTO object from the Request object
     */
    public function toDto(): CreateUserDto
    {
        return CreateUserDto::fromRequest($this);
    }
}
