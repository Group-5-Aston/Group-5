<x-newheader>
    <!-- Basket Section -->
    <main class="basket-container">
        <section class="basket-items">
            <h1 class="basket-title">Basket</h1>
            <a href="shop" class="basket-button">Continue Shopping</a>
            @if(!empty($basket) && count($basket) > 0)
                @foreach($basket as $index => $item)
                    <div class="item">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                        <p class="item-name">{{ $item['name'] }}</p>
                        @if($item['flavor'])
                            <p class="item-flavor">Flavor: {{ $item['flavor'] }}</p>
                        @endif
                        @if($item['psize'])
                            <p class="item-psize">Package Size: {{ $item['psize'] }}</p>
                        @endif
                        @if($item['size'])
                            <p class="item-size">Size: {{ $item['size'] }}</p>
                        @endif
                        <p class="item-quantity">Quantity: {{ $item['quantity'] }}</p>
                        <p class="item-price">£{{ number_format($item['price'], 2) }}</p>
                        <form action="{{ route('basket.remove', ['index' => $index]) }}" method="POST">
                            @csrf
                            <button type="submit" class="remove-button">Remove</button>
                        </form>
                        <form action="{{ route('basket.add', $item['product_id']) }}" method="POST">
                        @csrf
                            <input type="hidden" name="name" value="{{ $item['name'] }}">
                            <input type="hidden" name="price" value="{{ $item['price'] }}">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="image" value="{{ $item['image'] }}">
                            <input type="hidden" name="size" value="{{ $item['size'] }}">
                            <input type="hidden" name="flavor" value="{{ $item['flavor'] }}">
                            <input type="hidden" name="psize" value="{{ $item['psize'] }}">
                            <!-- Hidden fields for subtotal, shipping, vat, and total -->
                            <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                            <input type="hidden" name="shipping" value="{{ $shipping }}">
                            <input type="hidden" name="vat" value="{{ $vat }}">
                            <input type="hidden" name="total" value="{{ $total }}">

    

                            <button type="submit" class="add-button">Add</button>
                        </form>
                    </div>
                @endforeach
            @else
            <p></p>    
            <p>Your basket is empty!</p>
            @endif
        </section>

        <!-- Order Summary -->
<aside class="order-summary">
    <h2 class="summary-title">Order Summary</h2>
    @if(!empty($basket) && count($basket) > 0)
    <div class="summary-details">
        <p>Subtotal</p>
        <p>£{{ number_format($subtotal, 2) }}</p>
    </div>
    <div class="summary-details">
        <p>Shipping</p>
        <p>£{{ number_format($shipping, 2) }}</p>
    </div>
    <div class="summary-details">
        <p>V.A.T</p>
        <p>£{{ number_format($vat, 2) }}</p>
    </div>
    <div class="summary-details summary-total">
        <p>Total</p>
        <p>£{{ number_format($total, 2) }}</p>
    </div>

    <a href="{{ route('checkout.index') }}" class="basket-button">Continue to Checkout →</a>
    @else
    <button class="checkout-button" disabled>Continue to Checkout →</button>
    <p class="empty-basket-message">You can't checkout with an empty basket!</p>
@endif
</aside>
    </main>

@include('components.newfooter')
</x-newheader>
