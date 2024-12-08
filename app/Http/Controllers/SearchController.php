<?php
namespace App\Http\Controllers;
use Controller;
use Product;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $products = Product::where('name', 'like', '%'.$query.'%')
            ->orWhere('description', 'like', '%'.$query.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('search', compact('products', 'query'));
    }
}
