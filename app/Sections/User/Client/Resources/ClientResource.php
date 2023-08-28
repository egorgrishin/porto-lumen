<?php

namespace Sections\User\Client\Resources;

use Core\Parents\BaseResource;
use Sections\User\Client\Models\Client;

class ClientResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        /** @var Client|null $client */
        $client = $this->resource;
        if (!$client) {
            return [];
        }

        return [
            'id'         => $this->when(isset($client->id), fn () => $client->id),
            'name'       => $this->when(isset($client->name), fn () => $client->name),
            'email'      => $this->when(isset($client->email), fn () => $client->email),
            'role_type'  => $this->when(isset($client->role_type), fn () => $client->role),
            'created_at' => $this->when(isset($client->created_at), fn () => $client->created_at),
            'updated_at' => $this->when(isset($client->updated_at), fn () => $client->updated_at),
            'deleted_at' => $this->when(isset($client->deleted_at), fn () => $client->deleted_at),
        ];
    }
}
