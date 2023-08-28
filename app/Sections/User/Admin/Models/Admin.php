<?php

namespace Sections\User\Admin\Models;

use Core\Classes\Illuminate\Database\Eloquent\Builder;
use Sections\User\Admin\Data\Factories\AdminFactory;
use Sections\User\Role\Models\Role;
use Sections\User\User\Models\User;

class Admin extends User
{
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
            $builder->where('role_type', Role::ADMIN);
        });
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): AdminFactory
    {
        return AdminFactory::new();
    }
}
