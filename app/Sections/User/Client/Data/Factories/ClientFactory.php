<?php

namespace Sections\User\Client\Data\Factories;

use Core\Parents\BaseFactory;
use Sections\User\Client\Models\Client;
use Sections\User\Role\Models\Role;

class ClientFactory extends BaseFactory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name'              => $this->faker->name(),
            'email'             => $this->faker->unique()->email,
            'email_verified_at' => $this->faker->dateTime(),
            'role'              => Role::CLIENT,
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
    }
}
