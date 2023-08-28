<?php

namespace Feature;

use Core\Parents\BaseTest;
use Sections\User\Admin\Models\Admin;
use Sections\User\Client\Models\Client;

class UpdateUserTest extends BaseTest
{
    public function testUpdateUser(): void
    {
        /** @var Client $user */
        $user = Client::factory()->create();
        $admin = Admin::factory()->make();
        [$name, $email] = ['Name', 'email@mail.com'];

        $this->actingAs($admin)
            ->patch("/api/v1/users/$user->id", [
                'name'     => $name,
                'email'    => $email,
            ])
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'role',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ],
            ])
            ->seeInDatabase('users', [
                'name'  => $name,
                'email' => $email,
            ]);
    }
}
