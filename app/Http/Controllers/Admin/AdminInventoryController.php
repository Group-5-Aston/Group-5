<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;


class AdminInventoryController extends Controller
{
    public function inventory(Request $request) {
        $search = $request->input('search');
        $products = Product::query();

        if (!empty($search)) {
            $products->where('name', 'like', "%$search%");
        }

        $products = $products->get();

        if ($request->ajax()) {
            return response()->json([
                'products' => $products->map(function ($product) {
                    return [
                        'product_id' => $product->product_id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'label' => $product->label,
                        'is_food' => $product->is_food,
                        'is_toy_or_bed' => $product->is_toy_or_bed,
                        'product_url' => route('adminproduct.show', ['product' => $product->product_id])
                    ];
                })
            ]);
        }

        return view('newpages.newadminpages.admininventory', compact('products'));
    }

    public function addProduct()
    {
        return view('newpages.newadminpages.adminaddproduct');

    }
}
