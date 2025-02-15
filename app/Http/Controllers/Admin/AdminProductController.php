<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAddOptionRequest;
use App\Models\Product;
use App\Models\ProductOption;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

Class  AdminProductController extends Controller
{
    //route to admin product page. passes along the product and the options to the view
    public function showProduct(Product $product)
    {
        $productOptions = $this->productOptions($product->product_id);
        return view('newpages.newadminpages.adminproduct', compact('product', 'productOptions'));
    }


    //Gets every option for product by product id
    public function productOptions(int $id)
    {
        return ProductOption::where('product_id', $id)->get();
    }

    //Updates the stock level of the product option
    public function updateOption(Request $request, ProductOption $option)
    {
        $validate = $request->validate([
            'stock' => 'required|integer|min:0',
        ]);

        $option->update($validate);
        return redirect()->back()->with('success', 'Stock updated successfully.');
    }

    public function addOption(AdminAddOptionRequest $request, Product $product)
    {
        $data = $request->validated();

        $exists = ProductOption::where('product_id', $product->product_id)
            ->where('flavor', $data['flavor'])
            ->where('size', $data['size'])
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['error' => 'This flavour and size combination already exists for this product.']);
        }

        $merged = array_merge($request->validated(), ['product_id' => $product->product_id]);
        ProductOption::create($merged);
        return redirect()->back()->with('success', 'Option added successfully.');
    }

    public function destroyOption(ProductOption $option)
    {
        $option->delete();
        return redirect()->back()->with('success', 'Option deleted successfully.');
    }
}
