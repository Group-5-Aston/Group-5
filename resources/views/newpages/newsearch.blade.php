<x-newheader>
    
            <!-- No products found -->
            <p class="text-center">No products found.</p>
        @else
            <div class="row">
                @foreach($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="box">
                            <!-- Link to the search-specific product page -->
                            <a href="{{ route('product.searchshow', ['product_id' => $product->product_id]) }}">
                                <!-- Product Image -->
                                <div class="img-box">
                                    <!-- Use Storage::url if your 'image' field is stored as a path in storage -->
                                    <img 
                                        src="{{ Storage::url($product->image) }}" 
                                        alt="{{ $product->name }}" 
                                        style="width: 100%; height: auto;"
                                    >
                                </div>
                                <!-- Product Details -->
                                <div class="detail-box">
                                    <h6>{{ $product->name }}</h6>
                                    <h6>
                                        Price
                                        <span>£{{ $product->price }}</span>
                                    </h6>
                                </div>
                                <!-- "New" Label (optional) -->
                                <div class="new">
                                    <span>New</span>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Button to return to the main shop page -->
            <div class="btn-box">
                <a href="{{ route('fullshop') }}">
                    Return to Main Products Page
                </a>
            </div>
        @endif
    </div>
</section>

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
