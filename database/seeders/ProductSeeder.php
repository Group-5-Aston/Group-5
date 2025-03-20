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
        // Product data
        $products = [
            [1, 'Bundle Dog Food', 46.0, 'High-quality dog food to keep your pet healthy and happy.', 'images/Hfrdk7AkiNP1ZyKYvt6BtVnCLuRyCv2DPaip70k5.jpg', 'This premium dog snack is designed to meet the highest nutritional standards.', 'dog', 'food'],
            [2, 'Bundle Cat Food', 55.0, 'High-quality cat food to keep your pet healthy and happy. Packed with nutrients and taste your cat will love!', 'images/2s78YPZNtZO1qbRh63fRTCVnQYwzVP7JGk1lZTxq.jpg', 'This premium cat food is designed to meet the highest nutritional standards. Perfect for active cats and those with special dietary needs.', 'cat', 'food'],
            [3, 'Dog Biscuits', 10.0, 'Treats for your dogs that would have your pet wanting to try again!', 'images/Pc9UTuZfay06Cp4vApIbSxlrQk9RyNcUfEJeTRCU.jpg', 'This premium dog snack is designed to meet the highest nutritional standards. Perfect for active dogs and those with special dietary needs.', 'dog', 'food'],
            [4, 'Cat Biscuits', 15.0, 'High-quality Cat snacks to keep your pet healthy and happy. Packed with nutrients and taste your cat will love!', 'images/e35RGYrm2NlFu0yeeiqQNNezNQjrspsc2M3vgRWQ.jpg', 'This premium cat treat is designed to meet the highest nutritional standards. Perfect for active dogs and those with special dietary needs.', 'cat', 'food'],
            [5, 'Protein Dog Food', 35.0, 'High-quality dog food to keep your pet healthy and happy. Packed with nutrients and taste your dog will love!', 'images/jvRKNi4EZixJq9wSAnfKw59p5lf3YNfD0ON3sQOh.jpg', 'This premium dog food is designed to meet the highest nutritional standards. Perfect for active dogs and those with special dietary needs.', 'dog', 'food'],
            [6, 'Wet Mixed Dog Food', 10.0, 'High-quality dog food to keep your pet healthy and happy. Packed with nutrients and taste your dog will love!', 'images/NrptkPoUyP6K5K0KImnk1KG2jY47z40DFfG9OOX1.jpg', 'This premium dog food is designed to meet the highest nutritional standards. Perfect for active dogs and those with special dietary needs', 'dog', 'food'],
            [7, 'Wet Mixed Cat Food', 20.0, 'High-quality cat food to keep your pet healthy and happy. Packed with nutrients and taste your cat will love!', 'images/1TP0fCto5WwOlYcBmGkp2EbUeKnQ9etOqKuxu6Sj.jpg', 'This premium cat food is designed to meet the highest nutritional standards. Perfect for active cats and those with special dietary needs', 'cat', 'food'],
            [8, 'Cat Protein Food', 50.0, 'High-quality cat food to keep your pet healthy and happy. Packed with nutrients and taste your cat will love!', 'images/XMcu239jcioOTHKoJkfQhz2mXBEmCQeuEwyR7VHh.jpg', 'This premium cat food is designed to meet the highest nutritional standards. Perfect for active cats and those with special dietary needs', 'cat', 'food'],
            [9, 'Dog Toys', 45.0, 'Toys for your pets that would make them fall in love', 'images/ANA37UnEykcsMfE7KzionR0BYMLNuJJ6fvUmgTdp.jpg', 'This premium dog toy is designed to meet the highest standards.', 'dog', 'toy'],
            [10, 'Cat Toy', 55.0, 'Toys for your pets that would make them fall in love', 'images/Ly7uVoGeHplklZ7rdCdBNkeSHAVRTjb5492n05dU.jpg', 'This premium cat toy is designed to meet the highest standards.', 'cat', 'toy'],
            [11, 'Dog Shampoo', 10.0, 'High-quality dog Shampoo to keep your pet healthy and happy.', 'images/8RSacHFlRRlHBdh3Gaf79bGyvwywnTRT6Ge39hKr.jpg', 'This premium dog shampoo is designed to meet the highest healthy standards.', 'dog', 'hygiene'],
            [12, 'Cat Shampoo', 15.0, 'High-quality cat Shampoo to keep your pet healthy and happy.', 'images/HbdmNtvZ5UjEwS7ad9zvRmVarkCGR3ey4Ry5clIP.jpg', 'This premium cat shampoo is designed to meet the highest healthy standards.', 'cat', 'hygiene'],
            [13, 'Dog Bed', 35.0, 'High-quality dog bed to keep your pet comfy and happy.', 'images/Wu3qjjubexu02kSTKqrIFQb3UIEe1E8IjG4CaOp3.jpg', 'This premium dog bed is designed to meet the highest comfort standards.', 'dog', 'bed'],
            [14, 'Cat Bed', 35.0, 'High-quality cat bed to keep your pet comfy and happy.', 'images/Vv4bD2LjHs6h3vv07MiDJOscmvHUFwnT9Z1fmmZx.jpg', 'This premium cat bed is designed to meet the highest comfort standards.', 'cat', 'bed'],
            [15, 'Cat Dental Products', 20.0, 'High-quality Cat Dental Products to keep your pet healthy and happy. Packed with nutrients and taste your cat will love!', 'images/6dxlcBw72zkGzoUZF0POnYwpjpu1d2lsLBKqYZU4.jpg', 'This premium Cat Dental Product is designed to meet the highest nutritional standards.', 'cat', 'hygiene'],
            [16, 'Dog Dental Products', 20.0, 'High-quality Dog Dental Products to keep your pet healthy and happy. Packed with nutrients and taste your dog will love!', 'images/fGkZoc93xuVm7wm7MeLHw6XQOXTMidlb9g9N3BgE.jpg', 'This premium Dog Dental Product is designed to meet the highest nutritional standards.', 'dog', 'hygiene'],
            [17, 'Soft Fleece Jacket', 45.0, NULL, 'images/SydTcJrwvGG3XsRvHCpS85cFbGMiB5wpMyNwZo7N.png', NULL, 'clothes'],
            [18, 'Heart Sleeves Jumper', 55.0, NULL, 'images/dclothes2.webp', NULL, 'clothes'],
            [19, 'Dog Seat Belt', 10.0, NULL, 'images/dclothes3.webp', NULL, 'dog', 'clothes'],
            [20, 'Cozy Knit Sweater', 15.0, NULL, 'images/dclothes4.webp', NULL, 'clothes'],
            [21, 'Bear Jumper', 35.0, NULL, 'images/dogclothes5.webp', NULL, 'clothes'],
            [22, 'Puffer Jacket with Sherpa Fur', 10.0, NULL, 'images/dogclothes6.webp', NULL, 'clothes'],
            [23, 'Chest Harness', 20.0, NULL, 'images/dogclothes7.webp', NULL, 'clothes'],
            [24, 'Polka Dot Scarf', 50.0, NULL, 'images/dogclothes8.webp', NULL, 'both', 'clothes'],
            [27, 'Ring', 12.0, 'Test', 'images/xBNRsgdGybnJCCsHootFRehj9svT0MvpGCWCGIfS.jpg', 'Test', NULL]
        ];

        foreach ($products as $product) {
            $productId = DB::table('Products')->insertGetId([
                'name' => $product[1],
                'price' => $product[2],
                'description' => $product[3],
                'image' => $product[4],
                'long_description' => $product[5],
                'category' => $product[6],
                'type' => $product[7],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
