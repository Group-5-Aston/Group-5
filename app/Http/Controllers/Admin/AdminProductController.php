<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

Class  AdminProductController extends Controller
{
    public function showProduct(Product $product)
    {
        return view('newpages.newadminpages.adminproduct', compact('product'));
    }
}

