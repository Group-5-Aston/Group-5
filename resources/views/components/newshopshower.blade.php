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
           
            <!-- Return to Home Button -->
            <div class="text-center mt-5">
            <a href="{{ route('home') }}" class="btn btn-success rounded-pill px-4 py-2" style="background-color: #4B7C47;">
                Return to Homepage
            </a>
        </div>
</div>

<style>
 /* Updated CSS to remove the divider lines */
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
    /* Removed border-bottom here */
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
    background-color: #4d7a2e;
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
    z-index: 10;
    transform: rotate(5deg);
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

.shop-btn {
    background-color: #4d7a2e;
    color: white;
    padding: 12px 28px;
    border-radius: 30px;
    display: inline-block;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(77, 122, 46, 0.2);
    position: relative;
    overflow: hidden;
}

.shop-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.7s ease;
}

.shop-btn:hover {
    background-color: #3a5a23;
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(77, 122, 46, 0.3);
}

.shop-btn:hover::before {
    left: 100%;

}
</style>
<section>
