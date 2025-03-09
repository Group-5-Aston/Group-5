<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id' => \App\Models\Order::factory(),
            'option_id' => fake()->randomNumber(),
            'name' => fake()->word(),
            'image' => fake()->imageUrl(),
            'size' => fake()->randomElement(['Small', 'Medium', 'Large']),
            'flavor' => fake()->word(),
            'quantity' => fake()->numberBetween(1, 10),
            'total' => fake()->randomFloat(2, 1, 100),
        ];
    }
}
