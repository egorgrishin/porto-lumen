<?php

namespace Sections\User\Client\Actions;

use Core\Parents\BaseAction;
use Illuminate\Support\Collection;
use Sections\User\Client\Dto\GetClientsDto;
use Sections\User\Client\Models\Client;
use Sections\User\Client\Scopes\GetClientsScope;

class GetClientsAction extends BaseAction
{
    /**
     * Returns a collection of clients
     */
    public function run(GetClientsDto $dto): Collection
    {
        return Client::query()
            ->pushScope(new GetClientsScope($dto))
            ->get();
    }
}
