<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 5, 500),
            'label' => $this->faker->boolean(),
            'image' => $this->faker->imageUrl(640, 480, 'animals', true),
            'description' => $this->faker->sentence(),
            'cat_or_dog' => $this->faker->randomElement(['cat', 'dog']),
            'type' => $this->faker->word(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

