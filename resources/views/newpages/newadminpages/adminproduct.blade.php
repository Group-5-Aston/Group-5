<h1>Product Details</h1>

<x-alert type="success" :message="session('success')"/>
<x-alert type="error" :message="session('error')"/>


<p>Product ID: {{ $product->product_id }}</p>
<form method="POST" action="{{ route('adminimage.edit', ['product' => $product->product_id]) }}"
      enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <img src="{{ Storage::url($product['image']) }}" alt="product image"> <br>
    <input type="file" name="image" id="image" required> <br>
    <input type="submit" value="Change image">
</form>
<form method="POST" action="{{route('adminproduct.edit', ['product' => $product->product_id])}}">
    @csrf
    @method('PATCH')
    <p>Name:</p> <br>
    <input type="text" name="name" value="{{ $product->name }}"> <br>
    <p>Animal:</p>
    <select name="cat_or_dog" required>
        <option value="cat" {{ $product->cat_or_dog == 'cat' ? 'selected' : '' }}>Cat</option>
        <option value="dog" {{ $product->cat_or_dog == 'dog' ? 'selected' : '' }}>Dog</option>
        <option value="both" {{ $product->cat_or_dog == 'both' ? 'selected' : '' }}>Both</option>
    </select> <br>
    <p>Product type</p>
    <select name="type" required>
        <option value="food" {{ $product->type == 'food' ? 'selected' : '' }}>Food</option>
        <option value="toy" {{ $product->type == 'toy' ? 'selected' : '' }}>Toy</option>
        <option value="hygiene" {{ $product->type == 'hygiene' ? 'selected' : '' }}>Hygiene</option>
        <option value="clothes" {{ $product->type == 'clothes' ? 'selected' : '' }}>Clothes</option>
        <option value="bed" {{ $product->type == 'bed' ? 'selected' : '' }}>Bed</option>
    </select>
    <p>Price:</p> <br>
    £<input type="text" name="price" value="{{ $product->price }}"> <br>
    <p>Label:</p> <br>
    <textarea rows="5" name="label" cols="50"> {{$product->label}}</textarea> <br>
    <p>Description:</p> <br>
    <textarea rows="5" name="description" cols="50"> {{$product->description}}</textarea> <br>
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
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this product?')">
                        Delete Product
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

<h1>Add Option</h1>
<form method="POST" action="{{ route('adminoption.add', ['product' => $product->product_id]) }}">
    @csrf
    <input type="text" name="size" placeholder="Size">
    <input type="text" name="flavor" placeholder="Flavour">
    <input type="text" name="stock" placeholder="Stock level">
    <input type="submit" value="Add">
</form>

<h1>Reviews</h1>
<table>
    <thead>
    <tr>
        <th>User name</th>
        <th>Rating</th>
        <th>Review</th>
    </tr>
    </thead>
    @foreach($product->reviews as $review)
        <tr>
            <td>{{$review->user->name}}</td>
            <td>{{$review->rating}}</td>
            <td>{{$review->review}}</td>
            <td>
                <form method="POST" action="{{ route('adminreview.destroy', $review) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this review?')">
                        Delete review
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

