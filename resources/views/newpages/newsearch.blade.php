<x-newheader>

    <!-- Display Search Results -->
    <h1 class="text-center">Search Results</h1>

    @if ($products->isEmpty())
        <p class="text-center">No products found.</p>
    @else
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3 mb-4">
                    <!-- Link to a product-specific page -->
                    <a href="{{ route('product.show', ['product' => $product->product_id]) }}">
    View Product
</a>

                        <div class="box shadow-sm p-3 rounded">
                            <!-- Product Image -->
                            <div class="img-box">
                                <img 
                                    src="{{ asset($product->image) }}" 
                                    alt="{{ $product->name }}" 
                                    class="img-fluid" 
                                    style="width: 100%; height: 200px; object-fit: cover;"
                                >
                            </div>
                            <!-- Product Name and Price -->
                            <div class="detail-box mt-3">
                                <h6 class="text-center">{{ $product->name }}</h6>
                                <h6 class="text-center text-success">£{{ $product->price }}</h6>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif

    @include('components.newfooter')

    <!-- Custom Styles -->
    <style>
        .product-card {
            text-decoration: none;
            color: black;
            transition: transform 0.2s ease-in-out;
        }
        .product-card:hover {
            transform: scale(1.05);
        }
        .box {
            background: white;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
        }
        .img-box img {
            border-radius: 5px;
        }
    </style>

</x-newheader>
