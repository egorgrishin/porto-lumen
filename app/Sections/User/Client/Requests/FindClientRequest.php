<?php

namespace Sections\User\Client\Requests;

use Core\Parents\BaseRequest;

class FindClientRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user && ($user->isAdmin() || $user->id == $this->route('id'));
    }
}
