<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

 class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('Products')->insert([
            [
                'name' => 'Bundle Dog Food',
                'price' => 45,
                'label' => 'High-quality dog food to keep your pet healthy and happy.',
                'image' => 'images/p1.jpg',
                'description' => 'This premium dog snack is designed to meet the highest nutritional standards.',
                'is_food' => true,
                'is_toy_or_bed' => false,
                'package_size_options' => json_encode(['Small (2kg)', 'Medium (5kg)', 'Large (10kg)']),
            ],
        ]);
    }
}
