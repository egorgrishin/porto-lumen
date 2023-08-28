<?php

namespace Sections\User\User\Dto;

use Core\Classes\Dto\Concerns\Constructable;
use Core\Parents\BaseDto;
use Sections\User\User\Requests\UpdateUserRequest;

readonly class UpdateUserDto extends BaseDto
{
    use Constructable;

    public int     $id;
    public ?string $name;
    public ?string $email;
    public ?string $role;
    public ?string $password;

    public static function fromRequest(UpdateUserRequest $request): self
    {
        return new self([
            'id' => $request->route('id'),
        ] + $request->safe()->toArray());
    }
}
