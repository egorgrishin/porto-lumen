<?php

namespace Sections\User\User\Models;

use DateTimeInterface;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;
use Sections\User\Role\Models\Role;

/**
 * @property int                    $id
 * @property string                 $name
 * @property string                 $email
 * @property DateTimeInterface|null $email_verified_at
 * @property string                 $role
 * @property string                 $password
 * @property DateTimeInterface      $created_at
 * @property DateTimeInterface      $updated_at
 * @property DateTimeInterface|null $deleted_at
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the role that owns the user.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_type', 'type');
    }

    /**
     * Determines whether the user is an administrator
     */
    public function isAdmin(): bool
    {
        return $this->role_type == Role::ADMIN;
    }
}
