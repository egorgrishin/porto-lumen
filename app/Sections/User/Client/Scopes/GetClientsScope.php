<?php

namespace Sections\User\Client\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Sections\User\Client\Dto\GetClientsDto;

readonly class GetClientsScope implements Scope
{
    /**
     * Create a new scope instance.
     */
    public function __construct(
        private GetClientsDto $dto,
    ) {}

    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder
            ->addSelect($this->dto->fields)
            ->where(function (Builder $query) {
                $query
                    ->when($this->dto->name, function (Builder $query) {
                        $query->orWhere('name', 'like', "%{$this->dto->name}%");
                    })
                    ->when($this->dto->email, function (Builder $query) {
                        $query->orWhere('email', 'like', "%{$this->dto->email}%");
                    });
            });
    }
}
