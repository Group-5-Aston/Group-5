<x-newheader>
    <div class="heading_container heading_center">
        <h2 style="padding-top:10px;">Product Details</h2>
    </div> <p></p>

    <x-alert type="success" :message="session('success')"/>
    <x-alert type="error" :message="session('error')"/>


    <div class="container2" style="padding-top:30px">
        <p><strong>Product ID:</strong> {{ $product->product_id }}</p>

        <form method="POST" action="{{ route('adminimage.edit', ['product' => $product->product_id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <img src="{{ Storage::url($product['image']) }}" alt="product image" class="product-image"> <br>
            <input type="file" name="image" id="image" required> <br>
            <input type="submit" value="Change Image" class="green-btn">
        </form>

        <form method="POST" action="{{ route('adminproduct.edit', ['product' => $product->product_id]) }}">
            @csrf
            @method('PATCH')
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{ $product->name }}" required>

            <label for="cat_or_dog">Animal:</label>
            <select name="cat_or_dog" required>
                <option value="cat" {{ $product->cat_or_dog == 'cat' ? 'selected' : '' }}>Cat</option>
                <option value="dog" {{ $product->cat_or_dog == 'dog' ? 'selected' : '' }}>Dog</option>
                <option value="both" {{ $product->cat_or_dog == 'both' ? 'selected' : '' }}>Both</option>
            </select>

            <label for="type">Product Type:</label>
            <select name="type" required>
                <option value="food" {{ $product->type == 'food' ? 'selected' : '' }}>Food</option>
                <option value="toy" {{ $product->type == 'toy' ? 'selected' : '' }}>Toy</option>
                <option value="hygiene" {{ $product->type == 'hygiene' ? 'selected' : '' }}>Hygiene</option>
                <option value="clothes" {{ $product->type == 'clothes' ? 'selected' : '' }}>Clothes</option>
                <option value="bed" {{ $product->type == 'bed' ? 'selected' : '' }}>Bed</option>
            </select>

            <label for="price">Price:</label>
            <input type="text" name="price" value="£ {{ $product->price }}" required>

            <label for="label">Label:</label>
            <textarea name="label" required>{{ $product->label }}</textarea>

            <label for="description">Description:</label>
            <textarea name="description">{{ $product->description }}</textarea>

            <input type="submit" value="Edit Product" class="green-btn">
        </form>

        <form method="POST" action="{{ route('adminproduct.destroy', ['product' => $product->product_id] ) }}">
            @csrf
            @method('DELETE')
            <input type="submit" value="Delete Product" class="red-btn" onclick="return confirm('Are you sure you want to delete this product?')">
        </form>

        <h2 style="padding-top: 40px">Stock Levels</h2>
        <table>
            <thead>
                <tr>
                    <th>Option ID</th>
                    <th>Size</th>
                    <th>Flavour</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productOptions as $option)
                <tr>
                    <td>{{ $option->option_id }}</td>
                    <td>{{ $option->size }}</td>
                    <td>{{ $option->flavor }}</td>
                    <td class="stock-field">
                        <form method="POST" action="{{ route('adminoption.edit', ['option' => $option->option_id]) }}" class="stock-form">
                            @csrf
                            @method('PATCH')
                            <input type="text" name="stock" value="{{ $option->stock }}" class="stock-input">
                            <input type="submit" value="Edit" class="green-btn">
                        </form>
                    </td>
                    <td class="delete-field">
                        <form method="POST" action="{{ route('adminoption.delete', ['option' => $option->option_id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="red-btn" onclick="return confirm('Are you sure you want to delete this option?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h2 style="padding-top: 40px">Add Stock Option</h2>
        <form method="POST" action="{{ route('adminoption.add', ['product' => $product->product_id]) }}">
            @csrf
            <input type="text" name="size" placeholder="Size">
            <input type="text" name="flavor" placeholder="Flavour">
            <input type="text" name="stock" placeholder="Stock level">
            <input type="submit" value="Add" class="green-btn">
        </form>

    <h2 class="section" style="padding-top: 40px">Reviews</h2>
        <table>
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($product->reviews as $review)
                <tr>
                    <td>{{ $review->user->name }}</td>
                    <td>{{ $review->rating }}</td>
                    <td>{{ $review->review }}</td>
                    <td>
                        <form method="POST" action="{{ route('adminreview.destroy', $review) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="red-btn" onclick="return confirm('Are you sure you want to delete this review?')">
                                Delete Review
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('admin.inventory') }}" class="back-btn section">← Back to Inventory</a>
    </div>


    @include('components.newfooter')

    <style>
        .container2 {
            width: 70%;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .stock-field {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .stock-form {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .stock-input {
            width: 60px;
            text-align: center;
        }

        .green-btn {
            background-color: #4a6425;
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s ease-in-out;
            width: 100%;
        }

        .green-btn:hover {
            background-color: #3b511f;
        }

        .red-btn {
            background-color: #990e0e;
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s ease-in-out;
            width: 100%;
        }

        .red-btn:hover {
            background-color: darkred;
        }

        .back-btn {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: #4a6425;
        }

        h2 {
    color: #426b1f;
}
    </style>
</x-newheader>
