<?php

namespace Sections\User\Client\Requests;

use Core\Parents\BaseRequest;
use Core\Rules\FieldsIsAvailable;
use Sections\User\Client\Dto\GetClientsDto;
use Sections\User\Client\Models\Client;

class GetClientsRequest extends BaseRequest
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
        return [
            'fields'   => ['required', 'array', new FieldsIsAvailable(Client::class)],
            'fields.*' => 'distinct|string',
            'name'     => 'nullable|string',
            'email'    => 'nullable|string',
        ];
    }

    /**
     * Returns the DTO object from the Request object
     */
    public function toDto(): GetClientsDto
    {
        return GetClientsDto::fromRequest($this);
    }
}
