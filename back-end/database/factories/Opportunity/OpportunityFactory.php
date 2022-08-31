<?php

namespace Database\Factories\Opportunity;

use App\Models\Opportunity\Opportunity;
use Illuminate\Database\Eloquent\Factories\Factory;

class OpportunityFactory extends Factory
{
    protected $model = Opportunity::class;

    public function definition()
    {
        return [
            'title' => fake()->word(),
            'client_id' => 1,
            'product_id' => 1,
            'seller_id' => 1
        ];
    }
}
