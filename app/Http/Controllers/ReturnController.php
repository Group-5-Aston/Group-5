<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index() {
        $returnItems = auth()->user()->returnItems;
        return view('newpages.returns', compact('returnItems'));
    }

}
