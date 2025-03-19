@props(['products'])

<section class="shop_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>{{ $slot }}</h2>
        </div>
        <div class="row">
            @foreach($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="product-card">
                        <a href="{{ route('product.show', ['product' => $product->product_id])}}">
                            <div class="product-image">
                                <img src="{{ Storage::url($product['image']) }}" alt="{{ $product->name }}">
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
                                    <small>{{$product->averageRating()}}</small>
                                    {!! $product->review_stars !!}
                                </div>
                                <div class="price">
                                    <span>£{{ $product->price }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
