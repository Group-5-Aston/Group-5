<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAddOptionRequest;
use App\Http\Requests\AdminUpdateProductRequest;
use App\Models\Product;
use App\Models\ProductOption;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\Storage;


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

        $product = $option->product;
        return redirect()->route('adminproduct.show', $product)->with('success', 'Stock updated successfully.');
    }

    public function addOption(AdminAddOptionRequest $request, Product $product)
    {
        $data = $request->validated();

        $exists = ProductOption::where('product_id', $product->product_id)
            ->where('flavor', $data['flavor'])
            ->where('size', $data['size'])
            ->exists();

        if ($exists) {
            return redirect()->route('adminproduct.show', $product)->withErrors(['error' => 'This flavour and size combination already exists for this product.']);
        }

        $merged = array_merge($request->validated(), ['product_id' => $product->product_id]);
        ProductOption::create($merged);
        return redirect()->route('adminproduct.show', $product)->with('success', 'Option added successfully.');
    }

    public function destroyOption(ProductOption $option)
    {
        $product = $option->product;
        $option->delete();
        return redirect()->route('adminproduct.show', $product)->with('success', 'Option deleted successfully.');
    }

    /* Changes the current product image to a new one uploaded by
    admin and deletes the old one */
    public function editImage(Request $request, Product $product)
    {
        $request->validate(['image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048']);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $updatedImage = $request->file('image')->store('images', 'public');

        $product->image = $updatedImage;
        $product->save();
        return redirect()->route('adminproduct.show', $product)->with('success', 'Image updated successfully.');
    }

    public function updateProduct(AdminUpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return redirect()->route('adminproduct.show', $product)->with('success', 'Product updated successfully.');
    }

    public function destroyProduct(Product $product)
    {
        $product->options()->delete();
        $product->delete();
        return redirect()->route('admin.inventory')->with('success', 'Product deleted successfully.');
    }
}
