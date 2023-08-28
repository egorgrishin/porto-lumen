<?php

namespace Sections\User\User\Dto;

use Core\Classes\Dto\Concerns\Constructable;
use Core\Parents\BaseDto;
use Sections\User\User\Requests\CreateUserRequest;

readonly class CreateUserDto extends BaseDto
{
    use Constructable;

    public string $name;
    public string $email;
    public string $role_type;
    public string $password;

    public static function fromRequest(CreateUserRequest $request): self
    {
        return new self($request->safe()->toArray());
    }
}
