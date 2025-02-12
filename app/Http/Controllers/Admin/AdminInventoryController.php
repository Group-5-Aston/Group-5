<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;


class AdminInventoryController extends Controller
{
    public function inventory() {
        $products = Product::all();
         return view('newpages.newadminpages.admininventory', compact('products'));
    }
}
