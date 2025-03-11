<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    public function definition(): array
    {
        // Generate price and quantity first
        $price = fake()->randomFloat(2, 1, 100);
        $quantity = fake()->numberBetween(1, 10);

        return [
            'order_id' => Order::factory(),
            'option_id' => fake()->randomNumber(),
            'name' => fake()->word(),
            'image' => fake()->imageUrl(),
            'size' => fake()->randomElement(['Small', 'Medium', 'Large']),
            'flavor' => fake()->word(),
            'quantity' => $quantity,
            'price' => $price,
            'total' => $price * $quantity, // Correct total calculation
        ];
    }
}

