<x-newheader>
/* <!-- <!-- Filter Bar (Styled to Match Website) --
<div class="container mt-3">
    <form method="GET" action="{{ route('filterProducts') }}" class="d-flex align-items-center justify-content-center bg-light p-2 rounded shadow-sm flex-wrap">
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

        <-- Category --
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

<!-- Custom CSS for Styling --
<style>
    .container form {
        background-color: #f9f7e6; /* Matches website background */
        padding: 10px 15px;
        border-radius: 8px;
        box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);
    }

    .form-group label {
        font-size: 14px;
        font-weight: 500;
    }

    .form-control, .form-select {
        height: 38px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        padding: 5px;
    }

    .btn-success {
        background-color: #4B7C47; /* Matches search button */
        color: white;
        border-radius: 5px;
        padding: 8px 15px;
        border: none;
    }

    .btn-success:hover {
        background-color: #3a5f35;
    }

    @media (max-width: 768px) {
        .form-group {
            flex-direction: column;
            align-items: flex-start;
        }

        .form-group label {
            margin-bottom: 5px;
        }

        .form-group input, .form-group select {
            width: 100%;
        }
    }
</style>

-->


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
