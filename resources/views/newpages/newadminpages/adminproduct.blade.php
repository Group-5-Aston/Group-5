<h1>Product Details</h1>

<form>
    <p>Product ID: {{ $product->product_id }}</p>
    <input type="text" value="{{ $product->name }}">
    <input type="text" value="{{ $product->price }}">
    <textarea rows="5" cols="50"> {{$product->label}}</textarea>
    <p> Product type:
            @if($product->is_food == '1')
                Food
            @else
                Toy/Bed
            @endif</p>
    <input type="submit" value="Edit product">
</form>

<h1>Stock levels</h1>
<p> {{ $productOptions }}</p>

