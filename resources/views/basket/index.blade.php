<x-newheader>

    <x-alert type="success" :message="session('success')" />
    <x-alert type="error" :message="session('error')" />

    <main class="container py-5">
        <div class="row">
            <!-- Basket Items Section -->
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="mb-0">Your Basket</h1>
                    <a href="{{ route('shop') }}" class="btn btn-outline-primary">Continue Shopping</a>
                </div>

                @if($basket->items->count() > 0)
                    @php
                        $subtotal = 0;
                        foreach ($basket->items as $item) {
                            $subtotal += $item->quantity * $item->price;
                        }
                        $shipping = 4.99;
                        $vat = 2.00;
                        $total = $subtotal + $shipping + $vat;
                    @endphp

                    @foreach($basket->items as $item)
                        <div class="card mb-3 shadow-sm">
                            <div class="row g-0">
                                <!-- Product Image -->
                                <div class="col-md-3 d-flex align-items-center justify-content-center p-2">
                                    <img
                                        src="{{ Storage::url($item->productOption->product->image ?? 'placeholder.png') }}"
                                        alt="{{ $item->productOption->product->name ?? 'Product' }}"
                                        class="img-fluid rounded"
                                        style="max-height: 120px; object-fit: cover;"
                                    >
                                </div>

                                <!-- Item Details -->
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->productOption->product->name }}</h5>

                                        @if($item->productOption->flavor)
                                            <p class="card-text mb-1">
                                                <strong>Flavor:</strong> {{ $item->productOption->flavor }}</p>
                                        @endif
                                        @if($item->productOption->size)
                                            <p class="card-text mb-1">
                                                <strong>Size:</strong> {{ $item->productOption->size }}</p>
                                        @endif

                                        <p class="card-text mb-1"><strong>Quantity:</strong> {{ $item->quantity }}</p>
                                        <p class="card-text"><strong>Price:</strong>
                                            £{{ number_format($item->price, 2) }}</p>
                                    </div>
                                </div>

                                <!-- Remove Button -->
                                <div class="col-md-3 d-flex align-items-center justify-content-center">
                                    <form action="{{ route('basket.removeItem', $item->bitem_id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @else
                    <div class="alert alert-warning mt-4">
                        Your basket is empty!
                    </div>
                @endif
            </div>

            <!-- Order Summary -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title">Order Summary</h4>

                        @if($basket->items->count() > 0)
                            <ul class="list-group mb-3">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Subtotal</span>
                                    <strong>£{{ number_format($basket->total / 1.20, 2) }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Shipping</span>
                                    <strong>
                                        @if($subtotal < 30.01)
                                            £{{ number_format($shipping, 2) }}
                                        @else
                                            £0
                                        @endif
                                    </strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>V.A.T</span>
                                    <strong>£{{ number_format(((($basket->total) * 0.20) / 1.20), 2) }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><strong>Total</strong></span>
                                    <strong>
                                        @if($basket->total < 30.01)
                                            £{{ number_format($basket->total + $shipping, 2) }}
                                        @else
                                            £{{ number_format($basket->total, 2) }}
                                        @endif
                                    </strong>
                                </li>
                            </ul>
                            <a href="{{ route('checkout.index') }}" class="btn btn-primary w-100">
                                Continue to Checkout →
                            </a>
                        @else
                            <p class="text-muted text-center mt-4">You can’t checkout with an empty basket!</p>
                            <button class="btn btn-secondary w-100" disabled>Checkout</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('components.newfooter')
</x-newheader>

