<?php

namespace Database\Factories;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReturnItem>
 */
class ReturnItemFactory extends Factory
{
    public function definition(): array
    {
        // Create an order item first
        $orderItem = OrderItem::factory()->create();

        // Generate a quantity
        $quantity = fake()->numberBetween(1, 5);
        return [
            'order_id' => \App\Models\Order::factory(),
            'order_item_id' => $orderItem->order_item_id,
            'reason' => fake()->sentence(),
            'status' => fake()->randomElement(['returned', 'refunded', 'rejected']),
            'quantity' => $quantity,
            'total' => $quantity * $orderItem->price,
        ];
    }
}

