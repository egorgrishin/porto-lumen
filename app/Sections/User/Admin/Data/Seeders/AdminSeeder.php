<?php

namespace Sections\User\Admin\Data\Seeders;

use Core\Parents\BaseSeeder;
use Sections\User\Admin\Models\Admin;

class AdminSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::factory()->create();
    }
}
