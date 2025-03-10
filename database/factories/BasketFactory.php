<?php

namespace Database\Factories;

use App\Models\Basket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BasketFactory extends Factory
{
    protected $model = Basket::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'total' => $this->faker->randomFloat(2, 1, 500),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
