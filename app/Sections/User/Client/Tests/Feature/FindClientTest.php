<?php

namespace Sections\User\Client\Tests\Feature;

use Core\Parents\BaseTest;
use Sections\User\Admin\Models\Admin;
use Sections\User\Client\Models\Client;

class FindClientTest extends BaseTest
{
    public function testFindClient(): void
    {
        /** @var Client $client */
        $client = Client::factory()->create();

        $this->actingAs(Admin::factory()->make())
            ->call('GET', "/api/v1/clients/$client->id")
            ->assertJsonStructure([
                'data' => [
                    'id', 'name', 'email',
                ],
            ])
            ->setStatusCode(200);
    }
}
