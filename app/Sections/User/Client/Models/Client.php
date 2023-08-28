<?php

namespace Sections\User\Client\Models;

use Core\Classes\Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sections\User\Client\Data\Factories\ClientFactory;
use Sections\User\Role\Models\Role;
use Sections\User\User\Models\User;

class Client extends User
{
    use HasFactory;

    /**
     * Defines the available fields to get through the request
     */
    public const OPEN_FIELDS = [
        'id',
        'name',
        'email',
    ];

    /**
     * The table associated with the model.
     */
    protected $table = 'users';

    /**
     * Perform any actions required after the model boots.
     */
    protected static function booted(): void
    {
        static::addGlobalScope('role', function (Builder $builder) {
            $builder->where('role_type', Role::CLIENT);
        });
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): ClientFactory
    {
        return ClientFactory::new();
    }
}
