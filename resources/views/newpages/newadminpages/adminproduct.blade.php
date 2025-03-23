<x-newheader>
    @include('components.validation-alert')

    <div class="container2" style="padding-top:30px">
        <h2>Product ID: {{ $product->product_id }}</h2>

        <form method="POST" action="{{ route('adminimage.edit', ['product' => $product->product_id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <img src="{{ Storage::url($product['image']) }}" alt="product image" class="product-image"> <br>
            <input type="file" class="form-control" name="image" id="image" required> <br>
            <input type="submit" value="Change Image" class="filter-btn">
        </form>

        <form method="POST" id="editForm" action="{{ route('adminproduct.edit', ['product' => $product->product_id]) }}">
            @csrf
            @method('PATCH')
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>

            <label for="cat_or_dog">Animal:</label>
            <select name="cat_or_dog" class="form-control" required>
                <option value="cat" {{ $product->cat_or_dog == 'cat' ? 'selected' : '' }}>Cat</option>
                <option value="dog" {{ $product->cat_or_dog == 'dog' ? 'selected' : '' }}>Dog</option>
                <option value="both" {{ $product->cat_or_dog == 'both' ? 'selected' : '' }}>Both</option>
            </select>

            <label for="type">Product Type:</label>
            <select name="type" class="form-control" required>
                <option value="food" {{ $product->type == 'food' ? 'selected' : '' }}>Food</option>
                <option value="toy" {{ $product->type == 'toy' ? 'selected' : '' }}>Toy</option>
                <option value="hygiene" {{ $product->type == 'hygiene' ? 'selected' : '' }}>Hygiene</option>
                <option value="clothes" {{ $product->type == 'clothes' ? 'selected' : '' }}>Clothes</option>
                <option value="bed" {{ $product->type == 'bed' ? 'selected' : '' }}>Bed</option>
            </select>

            <label for="price">Price:</label>
            <div style="display: flex; align-items: center; gap: 5px">
            <p style="margin: 0">£</p>
            <input type="text" class="form-control" name="price" value="{{ $product->price }}" required>
            </div>
            <label for="label">Label:</label>
            <textarea name="label" class="form-control" required>{{ $product->label }}</textarea>

            <label for="description">Description:</label>
            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
        </form>

        <div class="buttons">

        <button type="button" class="filter-btn" onclick="document.getElementById('editForm').submit();">
            Edit Product
        </button>

        <form method="POST" action="{{ route('adminproduct.destroy', ['product' => $product->product_id] ) }}">
            @csrf
            @method('DELETE')
            <input type="submit" value="Delete Product" class="delete-btn" onclick="return confirm('Are you sure you want to delete this product?')">
        </form>
        </div>

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
                    <td>
                        <form method="POST" id="optionEditForm" action="{{ route('adminoption.edit', ['option' => $option->option_id]) }}" class="stock-form">
                            @csrf
                            @method('PATCH')
                            <input type="text" class="form-control" style="width: 60px; text-align: center" name="stock" value="{{ $option->stock }}">
                        </form>
                    </td>
                    <td class="delete-field">
                        <button type="submit" onclick="document.getElementById('optionEditForm').submit();" class="small filter-btn">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <form method="POST" action="{{ route('adminoption.delete', ['option' => $option->option_id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="small delete-btn" onclick="return confirm('Are you sure you want to delete this option?')">
                                <i class="fa-solid fa-trash"></i>
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
            <input type="text" style="margin-top: 15px" class="form-control" name="size" placeholder="Size">
            <input type="text" style="margin-top: 15px" class="form-control" name="flavor" placeholder="Flavour">
            <input type="text" style="margin-top: 15px" class="form-control" name="stock" placeholder="Stock level">
            <input type="submit" style="margin-top: 10px" value="Add" class="filter-btn">
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
                            <button type="submit" class="small delete-btn" onclick="return confirm('Are you sure you want to delete this review?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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

        .delete-btn {
            background-color: red;
            color: white;
            border-radius: 30px;
            border: none;
            padding: 9px 20px;
            transition: background-color 0.3s ease-in-out;

        }

        .delete-field {
            display: flex;

        }
        .delete-btn:hover {
            background-color: darkred;
        }

        .delete-btn:disabled {
            background-color: lightgrey;
        }

        .back-btn {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: #4a6425;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }
    </style>
</x-newheader>
