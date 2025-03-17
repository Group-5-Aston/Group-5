<x-newheader :products="$products ?? []">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>Filter Products</h2>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4 mb-4">
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
                                    <option value="both" {{ request('animal') == 'both' ? 'selected' : '' }}>Both</option>
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
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                                <a href="{{ route('filter.page') }}" class="btn btn-secondary">Reset</a>
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
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="box">
                            <a href="{{ route('product.show', ['product' => $product->product_id]) }}">
                                <div class="img-box">
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                                </div>
                                <div class="detail-box">
                                    <h5>{{ $product->name }}</h5>
                                    <small>{{ $product->averageRating() }}</small>
                                    {!! $product->review_stars !!}
                                    <h4>
                                        <span>£{{ $product->price }}</span>
                                    </h4>
                                </div>
                                @if ($product->isNew())
                                    <div class="new">
                                        <span>New</span>
                                    </div>
                                @endif
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            No products found matching your criteria. Try adjusting your filters.
                        </div>
                    </div>
                @endforelse
            </div>
            
            <div class="btn-box">
                <a href="{{ route('fullshop') }}">
                    Return to Main Products Page
                </a>
            </div>
        @endif
    </div>
    
    @include('components.newfooter')
</x-newheader>
