<?php

namespace Core\Parents;

use Core\Classes\Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    /**
     * Defines the available fields to get through the request
     */
    public const OPEN_FIELDS = [];

    /**
     * Create a new Eloquent query builder for the model.
     */
    public function newEloquentBuilder($query): Builder
    {
        return new Builder($query);
    }
}
