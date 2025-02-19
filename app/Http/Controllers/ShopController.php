<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop() {
        return view('newpages.newshop');
    }

    public function fullShop() {
        return view('newpages.newshopfull');
    }

    public function catShop() {
        return view('newpages.newcat');
    }

    public function dogShop() {
        return view('newpages.newdog');
    }

    public function productPage() {
        return view('newpages.newproduct');
    }

    public function dogClothes() {
        return view('newpages.dogclothes');
    }

    public function catClothes() {
        return view('newpages.catclothes');
    }
}
