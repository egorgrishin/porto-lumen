<?php

namespace Core\Data\Seeders;

use Illuminate\Database\Seeder;
use Sections\User\Admin\Data\Seeders\AdminSeeder;
use Sections\User\Role\Data\Seeders\RoleSeeder;

class DatabaseSeeder extends Seeder
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
