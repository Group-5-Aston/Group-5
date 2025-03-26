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

    public function search(Request $request)
    {
        $query = $request->input('q');

        // If the user didn't type anything, return an empty collection
        if (!$query) {
            return view('newpages.newsearch', [
                'products' => collect(),
                'showProductDetails' => false
            ]);
        }

        // Use wildcards for partial matching
        $products = Product::where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->get();

        return view('newpages.newsearch', [
            'products' => $products,
            'showProductDetails' => false
        ]);
    }


    public function filterPage()
    {
        // Get all unique product types
        $productTypes = Product::distinct('type')->pluck('type')->filter();

        // Get min and max prices for range
        $minPrice = Product::min('price');
        $maxPrice = Product::max('price');

        return view('newpages.newfilter', compact('productTypes', 'minPrice', 'maxPrice'));
    }

    public function filterResults(Request $request)
    {
        $query = Product::query();

        // Filter by animal type
        if ($request->has('animal') && $request->animal != 'all') {
            if ($request->animal == 'both') {
                // Both cats and dogs
                $query->whereIn('cat_or_dog', ['cat', 'dog', 'both']);
            } else {
                // Either cat or dog
                $query->whereIn('cat_or_dog', [$request->animal, 'both']);
            }
        }

        // Filter by product type
        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        // Filter by price range
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', $request->max_price);
        }

        // Sort products
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->orderBy('product_id', 'desc');
                    break;
            }
        }

        $products = $query->get();
        $filterApplied = true;

        // Get the same metadata as the filter page
        $productTypes = Product::distinct('type')->pluck('type')->filter();
        $minPrice = Product::min('price');
        $maxPrice = Product::max('price');

        return view('newpages.newfilter', compact(
            'products',
            'productTypes',
            'minPrice',
            'maxPrice',
            'filterApplied'
        ));
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
        return view('newpages.newsearch', [
            'product' => $product,
            'products' => collect(), // Empty collection
            'showProductDetails' => true,
        ]);
    }

    public function show(Product $product)
    {
        $productOptions = $product->productOptions;
        $product->load('reviews');
        return view('products.product', compact('product', 'productOptions'));
    }


}

