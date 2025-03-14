<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductOption;
use Illuminate\Http\Request;

// Corrected import

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function search(Request $request) // Ensure Request is correctly imported
    {
        $query = $request->input('q');

        $products = Product::where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->get();

        return view('newpages.newsearch', ['products' => $products, 'products' => $products,
            'showProductDetails' => false]);
    }

    public function filter(Request $request)
    {
        $category_id = $request->input('category');
        $brand_id = $request->input('brand');

        $products = Product::query();

        if ($category_id) {
            $products->where('category_id', $category_id);
        }

        if ($brand_id) {
            $products->where('brand_id', $brand_id);
        }

        $products = $products->get();

        return view('product.filter', compact('products'));
    }

    public function searchShow($product_id)
    {

        // Find the product by its ID
        $product = Product::find($product_id);

        // If the product doesn't exist, return a 404 error
        if (!$product) {
            abort(404, 'Product not found');
        }

        // Return the search-specific product details view
        return view('newpages.newsearch', ['product' => $product, 'products' => collect(), // Empty collection
            'showProductDetails' => true,]);
    }

    public function show(Product $product)
    {
        $productOptions = $product->productOptions;
        $product->load('reviews');
        return view('products.product', compact('product', 'productOptions'));
    }

  

}

