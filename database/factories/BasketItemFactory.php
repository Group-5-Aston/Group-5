<?php

namespace Database\Factories;

use App\Models\Basket;
use App\Models\ProductOption;
use App\Models\BasketItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class BasketItemFactory extends Factory
{
    protected $model = BasketItem::class;

    public function definition(): array
    {
        $quantity = $this->faker->numberBetween(1, 5);
        $price = $this->faker->randomFloat(2, 5, 100);
        return [
            'basket_id' => Basket::factory(),
            'option_id' => ProductOption::factory(),
            'quantity' => $quantity,
            'price' => $price,
            'total' => $quantity * $price,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

