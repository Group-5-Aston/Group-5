<?php

namespace Database\Factories;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReturnItem>
 */
class ReturnFactory extends Factory
{
    public function definition(): array
    {
        // Create an order item first
        $orderItem = OrderItem::factory()->create();

        // Generate a quantity
        $quantity = fake()->numberBetween(1, 5);
        return [
            'order_id' => \App\Models\Order::factory(),
            'order_item_id' => \App\Models\OrderItem::factory(),
            'reason' => fake()->sentence(),
            'status' => fake()->randomElement(['pending', 'refunded', 'rejected']),
            'quantity' => $quantity,
            'total' => $quantity * $orderItem->price, // Correct total calculation
        ];
    }
}

