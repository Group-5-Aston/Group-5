<?php

namespace App\Http\Controllers;

use Product;
use Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $products = Product::where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->get();
        return view('product.search', compact('products'));
    }

    public function filter(Request $request)
    {
        $category_id = $request->input('category');
        $brand_id = $request->input('brand');

        if ($category_id) {
            $products = Product::where('category_id', $category_id)->get();
        } elseif ($brand_id) {
            $products = Product::where('brand_id', $brand_id)->get();
        }

        return view('product.filter', compact('products'));
    }

    public function show($product)
    {
        $products = [
            'product1' => [
                'name' => 'Bundle Dog Food',
                'price' => 45,
                'label' => 'High-quality dog food to keep your pet healthy and happy.',
                'image' => 'images/p1.jpg',
                'description' => 'This premium dog snack is designed to meet the highest nutritional standards.',
                'is_food' => true, // This is a food item
                'is_toy_or_bed' => false, // Not a toy or bed
                'size_options' => null, // No size options
                'flavor_options' => ['chicken', 'beef', 'salmon'], // Available flavors
                'package_size_options' => ['Small (2kg)', 'Medium (5kg)', 'Large (10kg)'], // Package sizes for food
                 ],

            'product2' => [
                'name' => 'Bundle Cat Food',
                'price' => 55,
                'label' => 'High-quality cat food to keep your pet healthy and happy. Packed with nutrients and taste your cat will love!',
                'image' => 'images/p2.jpg',
                'description' => 'This premium cat food is designed to meet the highest nutritional standards. Perfect for active cats and those with special dietary needs.',
                'is_food' => true, // This is a food item
                'is_toy_or_bed' => false, // Not a toy or bed
                'size_options' => null, // No size options
                'flavor_options' => ['chicken', 'beef', 'salmon'], // Available flavors
                'package_size_options' => ['Small (2kg)', 'Medium (5kg)', 'Large (10kg)'], // Package sizes for food
                 ],

            'product3' => [
                'name' => 'Dog Biscuits',
                'price' => 10,
                'label' => 'Treats for your dogs that would have your pet wanting to try again!',
                'image' => 'images/p3.jpg',
                'description' => 'This premium dog snack is designed to meet the highest nutritional standards. Perfect for active dogs and those with special dietary needs.',
                'is_food' => true, // This is a food item
                'is_toy_or_bed' => false, // Not a toy or bed
                'size_options' => null, // No size options
                'flavor_options' => ['Chocolate', 'Vanilla', 'Strawberry', 'Coconut'], // Available flavors
                'package_size_options' => ['Small (2kg)', 'Medium (5kg)', 'Large (10kg)'], // Package sizes for food
                 ],

            'product4' => [
                'name' => 'Cat Biscuits',
                'price' => 15,
                'label' => 'High-quality Cat snacks to keep your pet healthy and happy. Packed with nutrients and taste your cat will love!',
                'image' => 'images/p4.jpg',
                'description' => 'This premium cat treat is designed to meet the highest nutritional standards. Perfect for active dogs and those with special dietary needs.',
                'is_food' => true, // This is a food item
                'is_toy_or_bed' => false, // Not a toy or bed
                'size_options' => null, // No size options
                'flavor_options' => ['Chocolate', 'Vanilla', 'Strawberry', 'Coconut'], // Available flavors
                'package_size_options' => ['Small (2kg)', 'Medium (5kg)', 'Large (10kg)'], // Package sizes for food
                 ],

                 'product5' => [
                    'name' => 'Protein Dog Food',
                    'price' => 35,
                    'label' => 'High-quality dog food to keep your pet healthy and happy. Packed with nutrients and taste your dog will love!',
                    'image' => 'images/p5.jpg',
                    'description' => 'This premium dog food is designed to meet the highest nutritional standards. Perfect for active dogs and those with special dietary needs.',
                    'is_food' => true, // This is a food item
                    'is_toy_or_bed' => false, // Not a toy or bed
                    'size_options' => null, // No size options
                    'flavor_options' => ['Chocolate', 'Vanilla', 'Strawberry'], // Available flavors
                    'package_size_options' => ['Small (2kg)', 'Medium (5kg)', 'Large (10kg)'], // Package sizes for food
                     ],

                     'product6' => [
                    'name' => 'Wet Mixed Dog Food',
                    'price' => 10,
                    'label' => 'High-quality dog food to keep your pet healthy and happy. Packed with nutrients and taste your dog will love!',
                    'image' => 'images/p6.jpg',
                    'description' => 'This premium dog food is designed to meet the highest nutritional standards. Perfect for active dogs and those with special dietary needs',
                    'is_food' => true, // This is a food item
                    'is_toy_or_bed' => false, // Not a toy or bed
                    'size_options' => null, // No size options
                    'flavor_options' => ['Chocolate', 'Vanilla', 'Strawberry'], // Available flavors
                    'package_size_options' => ['Small (2kg)', 'Medium (5kg)', 'Large (10kg)'], // Package sizes for food
                     ],

                     'product7' => [
                    'name' => 'Wet Mixed Cat Food',
                    'price' => 20,
                    'label' => 'High-quality cat food to keep your pet healthy and happy. Packed with nutrients and taste your cat will love!',
                    'image' => 'images/p7.jpg',
                    'description' => 'This premium cat food is designed to meet the highest nutritional standards. Perfect for active cats and those with special dietary needs',
                    'is_food' => true, // This is a food item
                    'is_toy_or_bed' => false, // Not a toy or bed
                    'size_options' => null, // No size options
                    'flavor_options' => ['Chocolate', 'Vanilla', 'Strawberry'], // Available flavors
                    'package_size_options' => ['Small (2kg)', 'Medium (5kg)', 'Large (10kg)'], // Package sizes for food
                     ],

                     'product8' => [
                        'name' => 'Cat Protein Food',
                        'price' => 50,
                        'label' => 'High-quality cat food to keep your pet healthy and happy. Packed with nutrients and taste your cat will love!',
                        'image' => 'images/p8.jpg',
                        'description' => 'This premium cat food is designed to meet the highest nutritional standards. Perfect for active cats and those with special dietary needs',
                        'is_food' => true, // This is a food item
                        'is_toy_or_bed' => false, // Not a toy or bed
                        'size_options' => null, // No size options
                        'flavor_options' => ['Chocolate', 'Vanilla', 'Strawberry'], // Available flavors
                        'package_size_options' => ['Small (2kg)', 'Medium (5kg)', 'Large (10kg)'], // Package sizes for food
                         ],

                         'product9' => [
                        'name' => 'Dog Toys',
                        'price' => 45,
                        'label' => 'Toys for your pets that would make them fall in love',
                        'image' => 'images/p9.jpg',
                        'description' => 'This premium dog toy is designed to meet the highest standards.',
                        'is_food' => null, // This is a food item
                        'is_toy_or_bed' => true, // Not a toy or bed
                        'size_options' => ['Small', 'Medium', 'Large'], // No size options
                            'flavor_options' => null, // Available flavors
                            'package_size_options' => null, // Package sizes for food
                         ],

                         'product10' => [
                            'name' => 'Cat Toy',
                            'price' => 55,
                            'label' => 'Toys for your pets that would make them fall in love',
                            'image' => 'images/p10.jpg',
                            'description' => 'This premium cat toy is designed to meet the highest standards.',
                            'is_food' => null, // This is a food item
                            'is_toy_or_bed' => true, // Not a toy or bed
                            'size_options' => ['Small', 'Medium', 'Large'], // No size options
                            'flavor_options' => null, // Available flavors
                            'package_size_options' => null, // Package sizes for food
                             ],

                             'product11' => [
                            'name' => 'dog shampoo',
                            'price' => 10,
                            'label' => 'High-quality dog Shampoo to keep your pet healthy and happy.',
                            'image' => 'images/p11.jpg',
                            'description' => 'This premium dog shampoo is designed to meet the highest healthy standards.',
                            'is_food' => null, // This is a food item
                            'is_toy_or_bed' => true, // Not a toy or bed
                            'size_options' => ['Small 500ml', 'Medium 1.5L', 'Large 2L'], // No size options
                            'flavor_options' => null, // Available flavors
                            'package_size_options' => null, // Package sizes for food
                             ],
    
                             'product12' => [
                                'name' => 'cat shampoo',
                                'price' => 15,
                                'label' => 'High-quality cat Shampoo to keep your pet healthy and happy.',
                                'image' => 'images/p12.jpg',
                                'description' => 'This premium cat shampoo is designed to meet the highest healthy standards.',
                                'is_food' => null, // This is a food item
                                'is_toy_or_bed' => true, // Not a toy or bed
                                'size_options' => ['Small 500ml', 'Medium 1.5L', 'Large 2L'], // No size options
                                'flavor_options' => null, // Available flavors
                                'package_size_options' => null, // Package sizes for food
                                 ],

                                 'product13' => [
                                    'name' => 'Dog Bed',
                                    'price' => 35,
                                    'label' => 'High-quality dog bed to keep your pet comfy and happy.',
                                    'image' => 'images/p13.jpg',
                                    'description' => 'This premium dog bed is designed to meet the highest comfort standards.',
                                    'is_food' => null, // This is a food item
                                    'is_toy_or_bed' => true, // Not a toy or bed
                                    'is_shampoo' => null, // is or isnt shampoo
                                    'shampoo_size_options'  => null, 
                                    'size_options' => ['Small', 'Medium', 'Large'], // No size options
                                    'flavor_options' => null, // Available flavors
                                    'package_size_options' => null, // Package sizes for food
                                     ],

                                     'product14' => [
                                        'name' => 'Cat Bed',
                                        'price' => 35,
                                        'label' => 'High-quality cat bed to keep your pet comfy and happy.',
                                        'image' => 'images/p14.jpg',
                                        'description' => 'This premium cat bed is designed to meet the highest comfort standards.',
                                        'is_food' => null, // This is a food item
                                        'is_toy_or_bed' => true, // Not a toy or bed
                                        'is_shampoo' => null, // is or isnt shampoo
                                        'shampoo_size_options'  => null,
                                        'size_options' => ['Small', 'Medium', 'Large'] ,// No size options
                                        'flavor_options' => null, // Available flavors
                                        'package_size_options' => null, // Package sizes for food
                                         ],

                                         'product15' => [
                                            'name' => 'Cat Dental Products',
                                            'price' => 20,
                                            'label' => 'High-quality Cat Dental Products to keep your pet healthy and happy. Packed with nutrients and taste your cat will love!',
                                            'image' => 'images/p15.jpg',
                                            'description' => 'This premium Cat Dental Product is designed to meet the highest nutritional standards.',
                                            'is_food' => true, // This is a food item
                                            'is_toy_or_bed' => null, // Not a toy or bed 
                                            'size_options' => null, // No size options
                        'flavor_options' => ['mint', 'spearmint'], // Available flavors
                                            'package_size_options' => ['Small (2kg)', 'Medium (5kg)', 'Large (10kg)'] , // Package sizes for food
                                             ],

                                             'product16' => [
                                                'name' => 'Dog Dental Products',
                                                'price' => 20,
                                                'label' => 'High-quality Dog Dental Products to keep your pet healthy and happy. Packed with nutrients and taste your cat will love!',
                                                'image' => 'images/p16.jpg',
                                                'description' => 'This premium Dog Dental Product is designed to meet the highest nutritional standards.',
                                                'is_food' => true, // This is a food item
                                                'is_toy_or_bed' => null, // Not a toy or bed
                                                'size_options' => ['mint', 'spearmint'] , // Available flavors
                                                'package_size_options' => ['Small (2kg)', 'Medium (5kg)', 'Large (10kg)'] , // Package sizes for food
                                                 ],
            
        
    
        
    
                 
        ];


        // Check if the product exists in the array
        if (isset($products[$product])) {
            return view('products.product', ['product' => $products[$product]]);
        }

        // If product is not found, redirect to 404 or show an error page
        return abort(404, 'Product not found');
    }
}

