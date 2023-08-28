<?php

namespace Sections\User\Client\Actions;

use Core\Parents\BaseAction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Sections\User\Client\Models\Client;
use Sections\User\User\Models\User;

class FindClientAction extends BaseAction
{
    /**
     * Returns the client by ID
     * @throws ModelNotFoundException<User>
     */
    public function run(int $client_id): Client
    {
        /** @var Client */
        return Client::query()->findOrFail($client_id);
    }
}
