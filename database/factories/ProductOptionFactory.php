<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductOption;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductOptionFactory extends Factory
{
    protected $model = ProductOption::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'size' => $this->faker->randomElement(['Small', 'Medium', 'Large']),
            'flavor' => $this->faker->randomElement(['Chicken', 'Beef', 'Salmon', 'Vegetable']),
            'stock' => $this->faker->numberBetween(0, 100),
            'low_stock_notification_sent' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

