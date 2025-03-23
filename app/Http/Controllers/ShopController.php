<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function getProducts(string $type)
    {
        switch ($type) {
            case 'cat':
                return Product::where('cat_or_dog', 'cat')->get();

            case 'dog':
                return Product::where('cat_or_dog', 'dog')->get();

            case 'both':
                return Product::all();

            case 'catToys':
                return Product::whereIn('cat_or_dog', ['cat', 'both'])
                    ->where('type', 'toy')->get();

            case 'dogToys':
                return Product::whereIn('cat_or_dog', ['dog', 'both'])
                    ->where('type', 'toy')->get();

            case 'dogClothes':
                return Product::whereIn('cat_or_dog', ['dog', 'both'])
                    ->where('type', 'clothes')->get();

            case 'catClothes':
                return Product::whereIn('cat_or_dog', ['cat', 'both'])
                    ->where('type', 'clothes')->get();

            case 'catHygiene':
                return Product::whereIn('cat_or_dog', ['cat', 'both'])
                    ->where('type', 'hygiene')->get();

            case 'dogHygiene':
                return Product::whereIn('cat_or_dog', ['dog', 'both'])
                    ->where('type', 'hygiene')->get();

            case 'catBed':
                return Product::whereIn('cat_or_dog', ['cat', 'both'])
                    ->where('type', 'bed')->get();

            case 'dogBed':
                return Product::whereIn('cat_or_dog', ['dog', 'both'])
                    ->where('type', 'bed')->get();

            case 'catFood':
                return Product::whereIn('cat_or_dog', ['cat', 'both'])
                    ->where('type', 'food')->get();

            case 'dogFood':
                return Product::whereIn('cat_or_dog', ['dog', 'both'])
                    ->where('type', 'food')->get();

            default:
                return collect();
        }
    }

    /*
     * Creates the title of the shop depending on the shop
     */
    public function getTitle($animal, $type,)
    {
        if ($type === 'all' && $animal === 'all') {
            return 'All Products';
        } elseif ($type === 'all' && $animal === 'cat' || $type === 'all' && $animal === 'dog') {
            return 'check out our ' . $animal . ' products';
        } elseif ($type === 'clothes' && $animal === 'cat' || $type === 'clothes' && $animal === 'dog') {
            return $animal . "'s clothes and accessories";
        }
        else {
            return $animal . "'s " . $type;
        }
    }

    public function shop($animal, $type, $query)
    {
        $title = $this->getTitle($animal, $type);
        $products = $this->getProducts($query);
        return view('newpages.shop', compact('products', 'title'));
    }
}


