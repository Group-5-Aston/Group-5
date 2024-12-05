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
        // Example array of products, you can also use a model to fetch products from a database
        $products = [
            'product1' => [
                'name' => 'Bundle Dog Food',
                'price' => 45,
                'description' => 'High-quality dog food to keep your pet healthy and happy.',
                'image' => 'images/p1.jpg'
            ],
            'product2' => [
                'name' => 'Bundle Cat Food',
                'price' => 55,
                'description' => 'High-quality cat food to keep your pet healthy and happy. Packed with nutrients and taste your cat will love!',
                'image' => 'images/p2.jpg'
            ],
            'product3' => [
                'name' => 'Dog Biscuits',
                'price' => 10,
                'description' => 'Treats for your dogs that would have your pet wanting to try again!',
                'image' => 'images/p3.jpg'
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

