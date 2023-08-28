<?php

namespace Sections\User\Role\Models;

use Core\Parents\BaseModel;
use DateTimeInterface;

/**
 * @property string            $type
 * @property DateTimeInterface $created_at
 */
class Role extends BaseModel
{
    /**
     * Administrator role
     */
    public const ADMIN = 'admin';

    /**
     * Client role
     */
    public const CLIENT = 'client';

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'type';

    /**
     * The "type" of the primary key ID.
     */
    protected $keyType = 'string';

    /**
     * The name of the "updated at" column.
     */
    public const UPDATED_AT = null;
}
