<?php

namespace Sections\User\Role\Data\Seeders;

use Core\Parents\BaseSeeder;
use Sections\User\Role\Models\Role;

class RoleSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new Role();
        $admin->type = Role::ADMIN;
        $admin->save();

        $client = new Role();
        $client->type = Role::CLIENT;
        $client->save();
    }
}
