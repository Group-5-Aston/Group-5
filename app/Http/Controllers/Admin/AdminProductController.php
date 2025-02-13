<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductOption;

Class  AdminProductController extends Controller
{
    public function showProduct(Product $product)
    {
        $productOptions = $this->productOptions();
        return view('newpages.newadminpages.adminproduct', compact('product', 'productOptions'));
    }


    public function productOptions()
    {
        return ProductOption::where('product_id', 1)->get();
    }
}
