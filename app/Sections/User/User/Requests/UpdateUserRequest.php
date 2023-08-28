<?php

namespace Sections\User\User\Requests;

use Core\Parents\BaseRequest;
use Illuminate\Validation\Rule;
use Sections\User\Role\Models\Role;
use Sections\User\User\Dto\UpdateUserDto;
use Sections\User\User\Models\User;

class UpdateUserRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user && ($user->isAdmin() || $user->id == $this->route('id'));
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $user = new User();
        $role = Role::class;
        return [
            'name'      => 'nullable|string|max:255',
            'email'     => [
                'nullable',
                'email',
                'max:255',
                Rule::unique($user->getTable())->ignore($this->route('id')),
            ],
            'role_type' => "nullable|string|exists:$role,type|max:30",
            'password'  => "nullable|string",
        ];
    }

    /**
     * Returns the DTO object from the Request object
     */
    public function toDto(): UpdateUserDto
    {
        return UpdateUserDto::fromRequest($this);
    }
}
