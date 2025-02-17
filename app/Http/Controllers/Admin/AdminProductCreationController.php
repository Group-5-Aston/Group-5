<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminAddProductRequest;
use App\Models\Product;
use App\Models\ProductOption;

class AdminProductCreationController
{
    public function create(AdminAddProductRequest $request)
    {
        $data = $request->validated();

        $exists = Product::where('name', $data['name'])->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['error' => 'A product with the same name already exists.']);
        }

        $imgPath = $request->file('image')->store('images', 'public');


        $productData = [
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'image' => $imgPath,
            'label' => $data['label'],
        ];

        $product = Product::create($productData);

        $productOptionData = [
            'product_id' => $product->product_id,
            'size' => $data['size'],
            'flavor' => $data['flavor'],
            'stock' => $data['stock'],
        ];

        ProductOption::create($productOptionData);

        return redirect()->route('admin.inventory')->with('success', ' added successfully.');
    }
}
