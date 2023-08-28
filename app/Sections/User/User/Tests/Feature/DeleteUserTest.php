<?php

namespace Sections\User\User\Tests\Feature;

use Core\Parents\BaseTest;
use Sections\User\Admin\Models\Admin;
use Sections\User\Client\Models\Client;

class DeleteUserTest extends BaseTest
{
    public function testDeleteUser()
    {
        /** @var Client $user */
        $user = Client::factory()->create();
        $admin = Admin::factory()->make();

        $this->actingAs($admin)
            ->delete("/api/v1/users/$user->id")
            ->seeStatusCode(200)
            ->missingFromDatabase('users', [
                'name'       => $user->name,
                'email'      => $user->email,
                'deleted_at' => 'IS NULL',
            ]);
    }
}
