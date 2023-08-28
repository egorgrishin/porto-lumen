<?php

namespace Core\Data\Seeders;

use Core\Parents\BaseSeeder;
use Sections\User\Admin\Data\Seeders\AdminSeeder;
use Sections\User\Role\Data\Seeders\RoleSeeder;

class DatabaseSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
