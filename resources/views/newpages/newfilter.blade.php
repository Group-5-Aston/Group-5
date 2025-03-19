<x-newheader :products="$products ?? []">
    <div class="container">
        <div class="heading_container heading_center">
           
        </div>
        <style>
            /* Updated Filter Form Styling */
            .filter-card {
                border: 1px solid #e0e0c7;
                border-radius: 15px;
                overflow: hidden;
                background-color: #f9f9e8;
                box-shadow: 0 4px 12px rgba(77, 122, 46, 0.08);
                transition: all 0.3s ease;
                margin-bottom: 2rem;
                padding: 25px;
            }
            
            .filter-card:hover {
                box-shadow: 0 6px 16px rgba(77, 122, 46, 0.15);
                transform: translateY(-3px);
            }
            
            .filter-title {
                color: #3a5a23;
                font-weight: 600;
                margin-bottom: 20px;
                font-size: 1.3rem;
                text-align: center;
            }
            
            /* Form elements styling */
            .form-label {
                color: #4d7a2e;
                font-weight: 500;
                margin-bottom: 8px;
            }
            
            .form-select, .form-control {
                border: 1px solid #e0e0c7;
                border-radius: 25px;
                padding: 10px 15px;
                background-color: #fff;
                transition: all 0.3s ease;
            }
            
            .form-select:focus, .form-control:focus {
                border-color: #4B7C47;
                box-shadow: 0 0 0 0.2rem rgba(75, 124, 71, 0.25);
                outline: none;
            }
            
            .input-group-text {
                border-radius: 25px 0 0 25px;
                background-color: #4B7C47;
                color: #fff;
                border: none;
            }
            
            .input-group .form-control {
                border-radius: 0 25px 25px 0;
            }
            
            /* Button styling */
            .btn-filter {
                background-color: #4B7C47;
                color: #fff;
                border: none;
                padding: 12px 25px;
                border-radius: 25px;
                cursor: pointer;
                font-size: 16px;
                font-weight: 500;
                transition: all 0.3s ease;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                margin-right: 12px;
                margin-top: 10px;
            }
            
            .btn-filter:hover {
                background-color: #3a6240;
                box-shadow: 0 4px 8px rgba(58, 98, 64, 0.4);
                transform: translateY(-2px);
            }
            
            .btn-filter.reset {
                background-color: #e0e0c7;
                color: #3a5a23;
            }
            
            .btn-filter.reset:hover {
                background-color: #d0d0b7;
            }
            
            .button-group {
                text-align: center;
                margin-top: 20px;
            }
            
            /* Keep existing product card styling */
            .product-card {
                border: 1px solid #e0e0c7;
                border-radius: 12px;
                overflow: hidden;
                transition: all 0.4s ease;
                height: 100%;
                background-color: #fff;
                box-shadow: 0 4px 12px rgba(77, 122, 46, 0.08);
                position: relative;
            }
            .product-card:hover {
                transform: translateY(-7px);
                box-shadow: 0 8px 20px rgba(77, 122, 46, 0.15);
                border-color: #4d7a2e;
            }
            .product-card:hover .quick-view {
                opacity: 1;
            }
            .product-card:hover .product-image img {
                transform: scale(1.05);
            }
            .product-image {
                height: 200px;
                padding: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                background-color: #fff;
                overflow: hidden;
            }
            .product-image::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 30%;
                background: linear-gradient(to top, rgba(249, 249, 232, 0.3), transparent);
                z-index: 1;
            }
            .product-image img {
                max-height: 170px;
                max-width: 100%;
                object-fit: contain;
                transition: transform 0.5s ease;
                z-index: 2;
            }
            .product-info {
                padding: 18px;
                background: linear-gradient(to bottom, #f9f9e8, #f5f5dc);
                position: relative;
            }
            .product-info h5 {
                color: #3a5a23;
                font-weight: 600;
                margin-bottom: 8px;
                font-size: 1.05rem;
                transition: color 0.3s ease;
            }
            .product-card:hover .product-info h5 {
                color: #4d7a2e;
            }
            .rating {
                display: flex;
                align-items: center;
                gap: 5px;
                margin-bottom: 10px;
            }
            .price {
                font-size: 1.25rem;
                font-weight: 700;
                color: #4d7a2e;
                display: inline-block;
                position: relative;
            }
            .price::after {
                content: '';
                position: absolute;
                bottom: -3px;
                left: 0;
                width: 0;
                height: 2px;
                background-color: #4d7a2e;
                transition: width 0.3s ease;
            }
            .product-card:hover .price::after {
                width: 100%;
            }
            .new-badge {
                position: absolute;
                top: 15px;
                right: 15px;
                background-color: #4B7C47;
                color: white;
                padding: 6px 12px;
                border-radius: 20px;
                font-size: 0.8rem;
                font-weight: 600;
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
                z-index: 10;
            }
            .quick-view {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                background-color: rgba(77, 122, 46, 0.85);
                color: white;
                text-align: center;
                padding: 8px 0;
                font-size: 0.9rem;
                opacity: 0;
                transition: all 0.3s ease;
                z-index: 5;
            }
        </style>
        
        <div class="row">
            <div class="col-md-12">
                <div class="filter-card">
                    <h3 class="filter-title">Find Your Perfect Pet Products</h3>
                    <!-- Filter Form -->
                    <form action="{{ route('filter.results') }}" method="GET">
                        <div class="row">
                            <!-- Animal Type Filter -->
                            <div class="col-md-6 mb-3">
                                <label for="animal" class="form-label">Animal</label>
                                <select name="animal" id="animal" class="form-select">
                                    <option value="all" {{ request('animal') == 'all' ? 'selected' : '' }}>All Animals</option>
                                    <option value="cat" {{ request('animal') == 'cat' ? 'selected' : '' }}>Cats</option>
                                    <option value="dog" {{ request('animal') == 'dog' ? 'selected' : '' }}>Dogs</option>
                                    
                                </select>
                            </div>
                            
                            <!-- Product Type Filter -->
                            <div class="col-md-6 mb-3">
                                <label for="type" class="form-label">Product Type</label>
                                <select name="type" id="type" class="form-select">
                                    <option value="">All Types</option>
                                    @foreach($productTypes as $type)
                                        <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                            {{ ucfirst($type) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- Price Range Filter (Min) -->
                            <div class="col-md-6 mb-3">
                                <label for="min_price" class="form-label">Min Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">£</span>
                                    <input 
                                        type="number" 
                                        class="form-control" 
                                        name="min_price" 
                                        id="min_price" 
                                        value="{{ request('min_price', $minPrice) }}" 
                                        min="0" 
                                        step="0.01"
                                    >
                                </div>
                            </div>
                            
                            <!-- Price Range Filter (Max) -->
                            <div class="col-md-6 mb-3">
                                <label for="max_price" class="form-label">Max Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">£</span>
                                    <input 
                                        type="number" 
                                        class="form-control" 
                                        name="max_price" 
                                        id="max_price" 
                                        value="{{ request('max_price', $maxPrice) }}" 
                                        min="0" 
                                        step="0.01"
                                    >
                                </div>
                            </div>
                            
                            <!-- Sort Options -->
                            <div class="col-md-6 mb-3">
                                <label for="sort" class="form-label">Sort By</label>
                                <select name="sort" id="sort" class="form-select">
                                    <option value="">Default</option>
                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                                </select>
                            </div>
                            
                            <!-- Submit & Reset -->
                            <div class="col-12 button-group">
                                <button type="submit" class="btn-filter">Apply Filters</button>
                                <a href="{{ route('filter.page') }}" class="btn-filter reset">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Filter Results Section -->
        @if(isset($filterApplied) && $filterApplied)
            <div class="heading_container">
                <h4>Filter Results ({{ count($products) }} products found)</h4>
            </div>
            
            <div class="row">
                @forelse($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="product-card">
                            <a href="{{ route('product.show', ['product' => $product->product_id]) }}">
                                <div class="product-image">
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                                    @if ($product->isNew())
                                        <div class="new-badge">
                                            <span>New</span>
                                        </div>
                                    @endif
                                    <div class="quick-view">View Details</div>
                                </div>
                                <div class="product-info">
                                    <h5>{{ $product->name }}</h5>
                                    <div class="rating">
                                        <small>{{ $product->averageRating() }}</small>
                                        {!! $product->review_stars !!}
                                    </div>
                                    <div class="price">
                                        <span>£{{ $product->price }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center p-4" style="background-color: #f9f9e8; border: 1px solid #e0e0c7; border-radius: 15px; color: #3a5a23;">
                            No products found matching your criteria. Try adjusting your filters.
                        </div>
                    </div>
                @endforelse
            </div>
            
            <!-- Return to Home Button -->
            <div class="text-center mt-5 mb-4">
                <a href="{{ route('home') }}" class="btn-filter" style="padding: 14px 30px;">
                    Return to Homepage
                </a>
            </div>
        @endif
    </div>
        
    @include('components.newfooter')
</x-newheader>