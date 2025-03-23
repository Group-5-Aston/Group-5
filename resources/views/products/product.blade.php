<x-newheader>
    <!-- Product Section -->
    <div class="container my-5">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6">
                <img src="{{ Storage::url($product['image']) }}" alt="{{ $product['name'] }}"
                     class="product-image w-100 h-100"
                     style="border-radius: 12px; box-shadow: 0 8px 20px rgba(77, 122, 46, 0.15);">
            </div>

            <!-- Product Details -->
            <div class="col-md-6">
                <div class="product-details">
                    <h1>{{ $product->name }}</h1>
                    <h3>£{{ $product->price }}</h3>
                    <p>{{ $product->label }}</p>

                    <!-- Product Options -->
                    <form action="{{route('basket.add', ['product' => $product->product_id])}}" method="POST">
                        @csrf
                        <div class="product-options">
                            <!-- Quantity -->
                            <div class="form-group">
                                <label for="quantity">Quantity:</label>
                                <input type="number" id="quantity" name="quantity" min="1" value="1"
                                       class="form-control" style="width: 120px;">
                            </div>

                            <!-- Size Selection (for beds or toys that have a size) -->
                            @if(isset($productOptions) && $productOptions->whereNotNull('size')->count() > 0)
                                <div class="form-group">
                                    <label for="size">Size:</label>
                                    <select id="size" name="size" class="form-control">
                                        @foreach($productOptions->unique('size') as $psize)
                                            <option value="{{ $psize->size }}">{{ ucfirst($psize->size) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <!-- Flavor Selection -->
                            @if(isset($productOptions) && $productOptions->whereNotNull('flavor')->count() > 0)
                                <div class="form-group">
                                    <label for="flavor">Flavor:</label>
                                    <select id="flavor" name="flavor" class="form-control">
                                        @foreach($productOptions->unique('flavor') as $flavor)
                                            <option
                                                value="{{ $flavor->flavor }}">{{ ucfirst($flavor->flavor) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <!-- Hidden Inputs for the product details -->
                            <input type="hidden" name="name" value="{{ $product['name'] }}">
                            <input type="hidden" name="price" value="{{ $product['price'] }}">
                            <input type="hidden" name="image" value="{{ asset($product['image']) }}">
                            <!-- Add to Basket Button -->
                            <button type="submit" class="filter-btn" style="width: 100%">Add to Basket</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabs Section -->
            <div class="tabs-section" style="margin-top: 50px">
                <ul class="nav nav-tabs" id="productTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="description-tab" data-bs-toggle="tab" href="#description"
                           role="tab" aria-controls="description" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab"
                           aria-controls="reviews" aria-selected="false">Reviews</a>
                    </li>
                </ul>
                <div class="tab-content" id="productTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel"
                         aria-labelledby="description-tab">
                        <p class="mt-3">{{ $product['description'] }}</p>
                    </div>

                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">

                        <p>Average Rating:
                            @for ($i = 1; $i <= 5; $i++)
                                @if($i <= round($product->averageRating()))
                                    ⭐
                                @else
                                    ☆
                                @endif
                            @endfor
                            ({{ $product->reviews->count() }} reviews)
                        </p>

                        <!-- Display all reviews directly -->
                        @foreach($product->reviews as $review)
                            <div class="review">
                                <p><strong>By:</strong> {{ $review->user->name }}</p>
                                <p style="color: #959595">Reviewed on: {{$review->created_at->format('j F, Y')}}</p>
                                <p>
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            ⭐
                                        @else
                                            ☆
                                        @endif
                                    @endfor
                                </p>
                                <p>{{ $review->review }}</p>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @include('components.newfooter')
</x-newheader>
