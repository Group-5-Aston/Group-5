<x-newheader>

<div class="container py-5">
    @if($products->isEmpty())
        <!-- No products found -->
        <p class="text-center text-muted fs-4">No products found.</p>
    @else
        <div class="row g-4">
            @foreach($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="product-card shadow-sm border rounded-4 p-3 position-relative">
                        <a href="{{ route('product.searchshow', ['product_id' => $product->product_id]) }}" class="product-link">
                            
                            <!-- Product Image -->
                            <div class="product-image text-center mb-3">
                                <img src="{{ Storage::url($product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="img-fluid rounded-3 shadow-sm" 
                                     style="height: 180px; object-fit: contain;">
                            </div>

                            <!-- Product Details -->
                            <div class="product-info">
                                <h5 class="fw-bold text-dark">{{ $product->name }}</h5>
                                
                                <div class="rating text-muted d-flex align-items-center gap-1 mb-1">
                                    <span>{{ $product->averageRating() }}</span>
                                    {!! $product->review_stars !!}
                                </div>

                                <div class="price fw-semibold fs-5 text-dark">
                                    £{{ $product->price }}
                                </div>
                            </div>
                        </a>

                        @if($product->isNew())
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-success rounded-pill px-2 py-1">New</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Return to Home Button -->
        <div class="text-center mt-5">
            <a href="{{ route('home') }}" class="btn btn-success rounded-pill px-4 py-2" style="background-color: #4B7C47;">
                Return to Homepage
            </a>
        </div>
    @endif
</div>

@include('components.newfooter')

<!-- Custom Sleek Styling -->
<style>
    .product-card {
        background-color: #f7f6f2;
        border-radius: 16px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 0 0 2px #3b5e3b; /* Visible dark outline */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-card:hover {
        transform: scale(1.03);
        box-shadow: 0 0 0 2.5px #2f4d2f, 0 8px 16px rgba(0, 0, 0, 0.15); /* Darker outline and hover shadow */
    }

    .product-image img {
        transition: transform 0.3s ease;
    }

    .product-image img:hover {
        transform: scale(1.05);
    }

    .product-info h5 {
        margin-bottom: 8px;
        font-size: 1.1rem;
        color: #333;
    }

    .rating span {
        font-size: 0.9rem;
    }

    .rating .fa-star {
        color: #ffcc00;
    }

    .price {
        color: #333;
    }

    .btn {
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .btn:hover {
        background-color: #3a6240;
        box-shadow: 0 4px 8px rgba(58, 98, 64, 0.3);
    }

    .badge {
        font-size: 12px;
        font-weight: bold;
    }
</style>

</x-newheader>

