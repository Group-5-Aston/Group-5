<x-newheader>
    <!-- Checkout Section -->
    <section class="checkout-container">
        <!-- Checkout Items -->
        <div class="checkout-details">
            <h2 class="checkout-title">Your Items</h2>
    @foreach($basket as $item)
    <div class="item">
        <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}">
        <p class="item-name">{{ $item['name'] }}</p>
        @if(!empty($item['psize']))
            <p class="item-psize">Size: {{ ucfirst($item['psize']) }}</p>
        @endif
        @if(!empty($item['flavor']))
            <p class="item-flavor">Flavor: {{ ucfirst($item['flavor']) }}</p>
        @endif
        @if(!empty($item['size']))
            <p class="item-size">Size: {{ ucfirst($item['size']) }}</p>
        @endif
        <p class="item-quantity">Quantity: {{ $item['quantity'] }}</p>
        <p class="item-price">£{{ number_format($item['price'], 2) }}</p>

    </div>
@endforeach


        </div>

        <!-- Order Summary -->
        <div class="order-summary">
            <h2 class="summary-title">Order Summary</h2>
            <div class="summary-details">
                <span>Subtotal:</span>
                <span>£{{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="summary-details">
                <span>Shipping:</span>
                <span>£{{ number_format($shipping, 2) }}</span>
            </div>
            <div class="summary-details">
                <span>VAT:</span>
                <span>£{{ number_format($vat, 2) }}</span>
            </div>
            <div class="summary-details summary-total">
                <span>Total:</span>
                <span>£{{ number_format($total, 2) }}</span>
            </div>
            <a href="{{ route('payment.index') }}" class="checkout-button">Proceed to Payment</a>
        </div>
    </section>
    @include('components.newcompactfooter')
</x-newheader>
