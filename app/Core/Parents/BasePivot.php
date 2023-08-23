<?php

namespace Core\Parents;

use Illuminate\Database\Eloquent\Relations\Concerns\AsPivot;

abstract class BasePivot extends BaseModel
{
    use AsPivot;

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = false;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];
}
