<?php

namespace Sections\User\User\Tests\Feature;

use Core\Parents\BaseTest;
use Illuminate\Support\Facades\DB;
use Sections\User\Admin\Models\Admin;

class CreateUserTest extends BaseTest
{
    public function testCreateUser(): void
    {
        $admin = Admin::factory()->make();
        [$name, $email] = ['Name', 'email@mail.com'];

        $this->actingAs($admin)
            ->post('/api/v1/users', [
                'name'     => $name,
                'email'    => $email,
                'role'     => 'admin',
                'password' => 'Password',
            ])
            ->seeStatusCode(201)
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