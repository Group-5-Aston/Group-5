<h1>Product Details</h1>

<p>Product ID: {{ $product->product_id }}</p>
<form method="POST" action="{{ route('adminimage.edit', ['product' => $product->product_id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <img src="{{ Storage::url($product['image']) }}" alt="product image">
    <input type="file" name="image" id="image" required>
    <input type="submit" value="Change image">
</form>
<form method="POST" action="{{route('adminproduct.edit', ['product' => $product->product_id])}}">
    @csrf
    @method('PATCH')
    <input type="text" name="name" value="{{ $product->name }}">
    <input type="text" name="price" value="{{ $product->price }}">
    <textarea rows="5" name="label" cols="50"> {{$product->label}}</textarea>
    <textarea rows="5" name="description" cols="50"> {{$product->description}}</textarea>
    <p> Product type:
            @if($product->is_food == '1')
                Food
            @else
                Toy/Bed
            @endif</p>
    <input type="submit" value="Edit product">
</form>

<form method="POST" action="{{ route('adminproduct.destroy', ['product' => $product->product_id] ) }}">
    @csrf
    @method('DELETE')
    <input type="submit" value="Delete product">
</form>

<h1>Stock levels</h1>
<table>
    <thead>
    <tr>
        <th>Option ID</th>
        <th>Size</th>
        <th>Flavour</th>
        <th>Stock</th>
    </tr>
    </thead>
@foreach($productOptions as $option)
    <tr>
        <td>{{$option->option_id}}</td>
        <td>{{$option->size}}</td>
        <td>{{$option->flavor}}</td>
        <td>
            <form method="POsT" action="{{ route('adminoption.edit', ['option' => $option->option_id]) }}">
                @csrf
                @method('PATCH')
                <input type="text" name="stock" value="{{$option->stock}}">
                <input type="submit" value="edit">
            </form>
            <form method="POST" action="{{ route('adminoption.delete', ['option' => $option->option_id]) }}">
                @csrf
                @method('DELETE')
                <input type="submit" value="Delete">
            </form>
        </td>
    </tr>
@endforeach
</table>

<h1>Add Option</h1>
<form method="POST" action="{{ route('adminoption.add', ['product' => $product->product_id]) }}" >
    @csrf
    <input type="text" name="size" placeholder="Size">
    <input type="text" name="flavor" placeholder="Flavour">
    <input type="text" name="stock" placeholder="Stock level">
    <input type="submit" value="Add">
</form>
