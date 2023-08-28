<?php

namespace Sections\User\Client\Controllers;

use Core\Parents\BaseController;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Sections\User\Client\Actions\FindClientAction;
use Sections\User\Client\Actions\GetClientsAction;
use Sections\User\Client\Requests\FindClientRequest;
use Sections\User\Client\Requests\GetClientsRequest;
use Sections\User\Client\Resources\ClientResource;

class ClientController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function get(GetClientsRequest $request): AnonymousResourceCollection
    {
        $clients = $this->action(GetClientsAction::class)->run(
            $request->toDto()
        );
        return ClientResource::collection($clients);
    }

    /**
     * Display the specified resource.
     */
    public function find(FindClientRequest $request): ClientResource
    {
        $client = $this->action(FindClientAction::class)->run(
            $request->route('id')
        );
        return new ClientResource($client);
    }
}
