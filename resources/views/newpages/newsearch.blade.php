<x-newheader>
    <!-- Search Results -->
    <div class="container mt-5">
        <h1 class="text-center">Search Results</h1>

        @if (empty($searchResults))
            <p class="text-center">No products found.</p>
        @else
            <div class="row">
                @foreach ($searchResults as $key => $product)
                    <div class="col-md-3 mb-4"> <!-- 4 products per row -->
                        <a href="{{ route('product.show', ['product' => $key]) }}" class="product-card">
                            <div class="box shadow-sm p-3 rounded">
                                <div class="img-box">
                                    <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="img-fluid" style="width: 100%; height: 200px; object-fit: cover;">
                                </div>
                                <div class="detail-box mt-3">
                                    <h6 class="text-center">{{ $product['name'] }}</h6>
                                    <h6 class="text-center text-success">£{{ $product['price'] }}</h6>
                                </div>
                                <div class="new text-center mt-2">
                                   
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

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
