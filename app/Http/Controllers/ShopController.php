<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function getProducts(String $animal) {
        if ($animal == 'cat') {
            return Product::where('cat_or_dog', 'cat')->get();
        } elseif ($animal == 'dog') {
            return Product::where('cat_or_dog', 'dog')->get();
        } elseif ($animal == 'both') {
            return Product::all();
        }
        return collect();
    }
    public function shop() {
        $products = $this->getProducts('both');
        return view('newpages.newshop', compact('products'));
    }

    public function fullShop() {
        $products = $this->getProducts('both');
        return view('newpages.newshopfull', compact('products'));
    }

    public function catShop() {
        $products = $this->getProducts('cat');
        return view('newpages.newcat', compact('products'));
    }

    public function dogShop() {
        $products = $this->getProducts('dog');
        return view('newpages.newdog', compact('products'));    }

    public function productPage(Product $product) {
        return view('newpages.newproduct', compact('product'));
    }

    public function dogClothes() {
        return view('newpages.dogclothes');
    }

    public function catClothes() {
        return view('newpages.catclothes');
    }
}
