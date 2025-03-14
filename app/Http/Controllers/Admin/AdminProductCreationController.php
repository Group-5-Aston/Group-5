<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminAddProductRequest;
use App\Models\Product;
use App\Models\ProductOption;

class AdminProductCreationController
{
    //Validates the creation of a new product and adds it to the database
    public function create(AdminAddProductRequest $request)
    {
        $data = $request->validated();

        $exists = Product::where('name', $data['name'])->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'A product with the same name already exists.');
        }

        $imgPath = $request->file('image')->store('images', 'public');


        $productData = [
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'image' => $imgPath,
            'label' => $data['label'],
            'cat_or_dog' => $data['cat_or_dog'],
            'type'=> $data['type'],
        ];

        $product = Product::create($productData);

        $productOptionData = [
            'product_id' => $product->product_id,
            'size' => $data['size'],
            'flavor' => $data['flavor'],
            'stock' => $data['stock'],
        ];

        ProductOption::create($productOptionData);

        return redirect()->route('admin.inventory')->with('success', 'Product added successfully.');
    }
}
