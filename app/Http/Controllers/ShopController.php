<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function getProducts(string $animal)
    {
        switch ($animal) {
            case 'cat':
                return Product::where('cat_or_dog', 'cat')->get();

            case 'dog':
                return Product::where('cat_or_dog', 'dog')->get();

            case 'catToys':
                return Product::whereIn('cat_or_dog', ['dog', 'both'])
                    ->where('type', 'toy')->get();

            case 'dogToys':
                return Product::whereIn('cat_or_dog', ['cat', 'both'])
                    ->where('type', 'toy')->get();

            case 'dogClothes':
                return Product::whereIn('cat_or_dog', ['dog', 'both'])
                    ->where('type', 'clothes')->get();

            case 'catClothes':
                return Product::whereIn('cat_or_dog', ['cat', 'both'])
                    ->where('type', 'clothes')->get();

            case 'both':
                return Product::all();

            case 'catGH':
                return Product::where('cat_or_dog', 'cat')
                    ->where('type', 'GH')->get();

            case 'dogGH':
                return Product::where('cat_or_dog', 'dog')
                    ->where('type', 'GH')->get();

            default:
                return collect();
        }
    }
    public function shop()
    {
        $products = $this->getProducts('both');
        return view('newpages.newshop', compact('products'));
    }

    public function fullShop()
    {
        $products = $this->getProducts('both');
        return view('newpages.newshopfull', compact('products'));
    }

    public function catShop()
    {
        $products = $this->getProducts('cat');
        return view('newpages.newcat', compact('products'));
    }

    public function dogShop()
    {
        $products = $this->getProducts('dog');
        return view('newpages.newdog', compact('products'));
    }

    public function productPage(Product $product)
    {
        return view('newpages.newproduct', compact('product'));
    }

    public function dogClothes()
    {
        $products = $this->getProducts('dogClothes');
        return view('newpages.dogclothes', compact('products'));
    }

    public function dogToys()
    {
        $products = $this->getProducts('dogToys');
        return view('newpages.dogtoys', compact('products'));
    }

    public function catClothes()
    {
        $products = $this->getProducts('catClothes');
        return view('newpages.catclothes', compact('products'));
    }

    public function catToys()
    {
        $products = $this->getProducts('catToys');
        return view('newpages.cattoys', compact('products'));
    }

    public function newcatGH()
    {
        $products = $this->getProducts('catGH');
        return view('newpages.newcatGH', compact('products'));
    }

    public function newdogGH()
    {
        $products = $this->getProducts('dogGH');
        return view('newpages.newdogGH', compact('products'));
    }







}


