<?php 

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request; // Corrected import

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

            return view('newpages.newsearch', compact('products')); 
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

    public function show($productId)
    {
        // Remove the 'product' prefix from the productId
        $productId = str_replace('product', '', $productId);

        // Now query the database with the correct product_id
        $product = Product::where('product_id', $productId)->first();

        if ($product) {
            // Convert the comma-separated strings into arrays if they exist
            $product->package_size_options = explode(',', $product->package_size_options ?? '');
            $product->flavor_options = explode(',', $product->flavor_options ?? '');
            $product->size_options = explode(',', $product->size_options ?? '');

            return view('products.product', ['product' => $product]);
        }

        // If product is not found, return a 404 error page
        return abort(404, 'Product not found');
    }
}

