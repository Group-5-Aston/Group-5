<x-newheader>
    <!-- Checkout Section -->
    <section class="checkout-container">
        <x-alert type="success" :message="session('success')" />
        <x-alert type="error" :message="session('error')" />
        <!-- Checkout Items -->
        <div class="checkout-details">
            <div class="checkout-title">
        <h2>Your Items</h2>
        </div>
        @foreach($basketItems as $item)
             <div class="item">
                 <img src="{{ Storage::url($item->productOption->product->image) }}" alt="{{ $item['name'] }}">
                 <p class="item-name">{{ $item->productOption->product->name }}</p>
                 @if(!empty($item->productOption->size))
                     <p class="item-psize">Size: {{ ucfirst($item->productOption->size) }}</p>
                 @endif
                 @if(!empty($item->productOption->flavor))
                     <p class="item-flavor">Flavor: {{ ucfirst($item->productOption->flavor) }}</p>
                 @endif
                 <p class="item-quantity">Quantity: {{ $item->quantity }}</p>
                 <p class="item-price">£{{ number_format($item->price, 2) }}</p>
             </div>
         @endforeach
        </div>

        <!-- Order Summary -->
        <form method="POST" action="{{route('payment.prepare')}}">
            @csrf
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
                <div class="summary-details">
                    <span>Delivering to {{auth()->user()->name}}</span>
                </div>
                <div class="summary-details">
                    <span>Shipping address:
                        <input type="text" style="border-radius: 30px" name="address" value="{{auth()->user()->address}}">
                    </span>
                </div>
                <div class="summary-details">
                    <span>Arriving {{ \Carbon\Carbon::now()->addDays(2)->format('j F, Y') }}</span>
                </div>
                <input type="submit" class="filter-btn" value="Proceed to checkout">
            </div>
        </form>
    </section>
    @include('components.newcompactfooter')
</x-newheader>
