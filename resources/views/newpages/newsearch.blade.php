<x-newheader>

<!-- Filter Bar (Styled to Match Website) --
<div class="container mt-3">
    <form method="GET" action="{{ route('product.filter') }}" class="d-flex align-items-center justify-content-center bg-light p-2 rounded shadow-sm flex-wrap">
        <!-- Min Price --
        <div class="form-group d-flex align-items-center mx-2">
            <label for="min_price" class="me-2 text-muted">Min Price:</label>
            <input type="number" id="min_price" name="min_price" value="{{ request('min_price') }}" class="form-control" placeholder="£0" style="width: 120px;">
        </div>

        <!-- Max Price --
        <div class="form-group d-flex align-items-center mx-2">
            <label for="max_price" class="me-2 text-muted">Max Price:</label>
            <input type="number" id="max_price" name="max_price" value="{{ request('max_price') }}" class="form-control" placeholder="£100" style="width: 120px;">
        </div>

        <!-- Category --
        <div class="form-group d-flex align-items-center mx-2">
            <label for="category" class="me-2 text-muted">Category:</label>
            <select id="category" name="category" class="form-select" style="width: 150px;">
                <option value="">All</option>
                <option value="food" {{ request('category') == 'food' ? 'selected' : '' }}>Food</option>
                <option value="toy_or_bed" {{ request('category') == 'toy_or_bed' ? 'selected' : '' }}>Toys & Beds</option>
            </select>
        </div>

        <!-- Apply Filters Button --
        <button type="submit" class="btn btn-success mx-2">Apply Filters</button>
    </form>
</div>

<!-- Search Results -->
<div class="container mt-5">
    <h1 class="text-center">Search Results</h1>

    @if ($products->isEmpty())
        <p class="text-center">No products found.</p>
    @else
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3 mb-4"> <!-- 4 products per row -->
                    <a href="{{ route('product.show', ['product' => $product->id]) }}" class="product-card">
                        <div class="box shadow-sm p-3 rounded">
                            <div class="img-box">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="width: 100%; height: 200px; object-fit: cover;">
                            </div>
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
