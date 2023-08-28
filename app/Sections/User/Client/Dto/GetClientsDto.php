<?php

namespace Sections\User\Client\Dto;

use Core\Classes\Dto\Concerns\Constructable;
use Core\Parents\BaseDto;
use Sections\User\Client\Requests\GetClientsRequest;

readonly class GetClientsDto extends BaseDto
{
    use Constructable;

    public array   $fields;
    public ?string $name;
    public ?string $email;

    public static function fromRequest(GetClientsRequest $request): self
    {
        return new self([
            'fields' => $request->get('fields'),
            'name'   => $request->get('name'),
            'email'  => $request->get('email'),
        ]);
    }
}
