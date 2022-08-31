<?php

namespace Database\Factories\Client;

use App\Models\Client\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{

    protected $model = Client::class;

    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
        ];
    }
}
