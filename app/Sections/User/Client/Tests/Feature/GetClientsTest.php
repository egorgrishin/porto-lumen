<?php

namespace Sections\User\Client\Tests\Feature;

use Core\Parents\BaseTest;
use Illuminate\Testing\Fluent\AssertableJson;
use Sections\User\Admin\Models\Admin;
use Sections\User\Client\Models\Client;

class GetClientsTest extends BaseTest
{
    public function testGetClients(): void
    {
        $clients_count = 5;
        Client::factory()->count($clients_count)->create();

        $this->actingAs(Admin::factory()->make())
            ->call('GET', '/api/v1/clients', [
                'fields' => ['id', 'name', 'email'],
            ])
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'email'],
                ],
            ])
            ->assertJson(function (AssertableJson $json) use ($clients_count) {
                $json->has('data', $clients_count);
            })
            ->setStatusCode(200);
    }
}
