<?php

namespace App\Http\Controllers\Auth;
use Controller;
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
}

