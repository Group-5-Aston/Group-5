<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReturnItem>
 */
class ReturnFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id' => \App\Models\Order::factory(),
            'order_item_id' => \App\Models\OrderItem::factory(),
            'reason' => fake()->sentence(),
            'status' => fake()->randomElement(['pending', 'refunded', 'rejected']),
            'quantity' => fake()->numberBetween(1, 5),
            'total' => fake()->randomFloat(2, 1, 100),
        ];
    }
}

