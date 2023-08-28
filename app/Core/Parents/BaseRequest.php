<?php

namespace Core\Parents;

use Core\Classes\Illuminate\Foundation\Http\FormRequest;
use Sections\User\User\Models\User;

/**
 * @method User|null user($guard = null)
 */
class BaseRequest extends FormRequest
{
    //
}
