
<x-newheader>
    <!-- Product Section -->
    <div class="container my-5">
    <div class="row">
    <!-- Product Image -->
        <div class="col-md-6">
            <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="product-image w-100">
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
        <div class="product-details">
            <h1>{{ $product['name'] }}</h1>
            <h3>£{{ $product['price'] }}</h3>
            <p>{{ $product['label'] }}</p>

            <!-- Product Options -->
            <form action="{{ route('basket.add', ['product_id' => $product['product_id']]) }}" method="POST">
            @csrf
            <p>Form action: {{ route('basket.add', ['product_id' => $product->product_id]) }}</p>
                <div class="product-options">
                    <!-- Quantity -->
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" min="1" value="1"  class="form-control" style="width: 120px;">
                    </div>
                    <!-- Check if it's food -->
                @if($product['is_food'])
                <!-- Package Size Selection -->
                    <div class="form-group">
                <label for="psize">Package Size:</label>
                <select id="psize" name="psize" class="form-control">
                    @foreach($product['package_size_options'] as $psize)
                        <option value="{{ $psize }}">{{ ucfirst($psize) }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Flavor Selection -->
            <div class="form-group">
                <label for="flavor">Flavor:</label>
                <select id="flavor" name="flavor" class="form-control">
                    @foreach($product['flavor_options'] as $flavor)
                        <option value="{{ $flavor }}">{{ ucfirst($flavor) }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <!-- Check if it's a toy or bed -->
        @if($product['is_toy_or_bed'])
            <!-- Size Selection (for beds or toys that have a size) -->
            <div class="form-group">
                <label for="size">Size:</label>
                <select id="size" name="size" class="form-control">
                    @foreach($product['size_options'] as $size)
                        <option value="{{ $size }}">{{ ucfirst($size) }}</option>
                    @endforeach
                </select>
            </div>
        @endif
                    <!-- Hidden Inputs for the product details -->
                    <input type="hidden" name="name" value="{{ $product['name'] }}">
                    <input type="hidden" name="price" value="{{ $product['price'] }}">
                    <input type="hidden" name="image" value="{{ asset($product['image']) }}">
                    <!-- Add to Basket Button -->
                    <button type="submit" class="btn btn-dark btn-block mt-4">Add to Basket</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabs Section -->
    <div class="tabs-section">
      <ul class="nav nav-tabs" id="productTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
        </li>
      </ul>
    <div class="tab-content" id="productTabContent">
        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
        <p class="mt-3">{{ $product['description'] }}</p>
        </div>
        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
        <p class="mt-3">No reviews yet. Be the first to review this product!</p>
        </div>
      </div>
    </div>
    </div>

    @include('components.newfooter')
</x-newheader>
