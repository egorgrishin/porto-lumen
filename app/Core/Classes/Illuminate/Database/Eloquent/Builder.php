<?php

namespace Core\Classes\Illuminate\Database\Eloquent;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Builder extends EloquentBuilder
{
    /**
     * Create a new Eloquent query builder instance.
     */
    public function __construct(QueryBuilder $query)
    {
        parent::__construct($query);
    }

    /**
     * Register a new scope.
     */
    public function pushScope(Scope $scope): self
    {
        $this->scopes[get_class($scope)] = $scope;
        return $this;
    }
}
