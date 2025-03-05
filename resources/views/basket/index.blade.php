<x-newheader>

<main class="container py-5">
    <div class="row">
        <!-- Basket Items Section -->
        <div class="col-md-8">
            <h1 class="mb-4">Basket</h1>
            <a href="{{ route('shop') }}" class="btn btn-link">Continue Shopping</a>

            @if($basket->items->count() > 0)
                @php
                    // Compute totals on the fly
                    $subtotal = 0;
                    foreach ($basket->items as $item) {
                        $subtotal += $item->quantity * $item->price;
                    }
                    $shipping = 4.99;
                    $vat = 2.00;
                    $total = $subtotal + $shipping + $vat;
                @endphp

                <!-- List each item -->
                @foreach($basket->items as $item)
                    <div class="card mb-3">
                        <div class="row g-0">
                            <!-- Product Image -->
                            <div class="col-md-3">
                                <img
                                    src="{{ $item->image }}"
                                    alt="{{ $item->name }}"
                                    class="img-fluid rounded-start"
                                >
                            </div>
                            <!-- Item Details -->
                            <div class="col-md-6">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->productOption->product->name }}</h5>
                                    @if($item->flavor)
                                        <p class="card-text">Flavor: {{ $item->flavor }}</p>
                                    @endif
                                    @if($item->size)
                                        <p class="card-text">Size: {{ $item->size }}</p>
                                    @endif
                                    <p class="card-text">Quantity: {{ $item->quantity }}</p>
                                    <p class="card-text">
                                        <strong>£{{ number_format($item->price, 2) }}</strong>
                                    </p>
                                </div>
                            </div>
                            <!-- Remove Button -->
                            <div class="col-md-3 d-flex align-items-center justify-content-center">
                                <form
                                    action="{{ route('basket.removeItem', $item->bitem_id) }}"
                                    method="POST"
                                >
                                    @csrf
                                    <!-- Using POST route, not DELETE -->
                                    <button type="submit" class="btn btn-danger">
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

            @else
                <p class="mt-4">Your basket is empty!</p>
            @endif
        </div>

        <!-- Order Summary -->
        <div class="col-md-4">
            <h2>Order Summary</h2>
            @if($basket->items->count() > 0)
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Subtotal</span>
                        <strong>£{{ number_format($subtotal, 2) }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Shipping</span>
                        <strong>£{{ number_format($shipping, 2) }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>V.A.T</span>
                        <strong>£{{ number_format($vat, 2) }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total</span>
                        <strong>£{{ number_format($total, 2) }}</strong>
                    </li>
                </ul>
                <a href="{{ route('checkout.index') }}" class="btn btn-primary w-100">
                    Continue to Checkout →
                </a>
            @else
                <p class="mt-4">You can’t checkout with an empty basket!</p>
                <button class="btn btn-secondary w-100" disabled>Checkout</button>
            @endif
        </div>
    </div>
</main>

@include('components.newfooter')
</x-newheader>

