        Session::put('shopping_cart', $shoppingCart);

        return redirect()->route('cart.index')->with('success', 'Product added to the cart!');
    }

    // Remove item from cart
    public function remove(Request $request)
    {
        $productId = $request->input('product_id');

        // Retrieve from the session
        $shoppingCart = Session::get('shopping_cart', []);

        // Remove product from cart
        if (($key = array_search($productId, $shoppingCart)) !== false) {
            unset($shoppingCart[$key]);
        }

        // Save cart back to session
        Session::put('shopping_cart', $shoppingCart);

        return redirect()->route('cart.index')->with('success', 'Product removed from the cart!');
    }


}
