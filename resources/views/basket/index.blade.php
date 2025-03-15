<x-newheader>

<x-alert type="success" :message="session('success')" />
<x-alert type="error" :message="session('error')" />

<main class="container py-5">
    <div class="row">
        <!-- Basket Items Section -->
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="display-5 fw-semibold" style="color: #3b5e3b;">Your Basket</h1>
                <a href="{{ route('shop') }}" class="btn btn-outline-success rounded-pill px-4 py-2" style="border-color: #3b5e3b; color: #3b5e3b;">
                    Continue Shopping
                </a>
            </div>

            @if($basket->items->count() > 0)
                @foreach($basket->items as $item)
                    <div class="card mb-4 shadow-sm border" style="background-color: #fdfde7; border-radius: 30px; border-color: #3b5e3b;">
                        <div class="row g-0 align-items-center p-4">
                            <!-- Product Image -->
                            <div class="col-md-3">
                                <img
                                    src="{{ Storage::url($item->productOption->product->image ?? 'placeholder.png') }}"
                                    alt="{{ $item->productOption->product->name ?? 'Product' }}"
                                    class="img-fluid rounded-5 shadow-sm"
                                    style="max-height: 140px; object-fit: cover;"
                                >
                            </div>

                            <!-- Item Details -->
                            <div class="col-md-5">
                                <div class="card-body p-0">
                                    <h5 class="card-title text-success fw-bold fs-4 mb-3" style="color: #3b5e3b;">
                                        {{ $item->productOption->product->name }}
                                    </h5>

                                    @if($item->productOption->flavor)
                                        <p class="card-text text-muted mb-2">
                                            <strong>Flavor:</strong> {{ $item->productOption->flavor }}
                                        </p>
                                    @endif

                                    @if($item->productOption->size)
                                        <p class="card-text text-muted mb-2">
                                            <strong>Size:</strong> {{ $item->productOption->size }}
                                        </p>
                                    @endif

                                    <p class="card-text text-muted mb-2">
                                        <strong>Quantity:</strong> {{ $item->quantity }}
                                    </p>

                                    <p class="card-text fs-5">
                                        <strong>£{{ number_format($item->price, 2) }}</strong>
                                    </p>
                                </div>
                            </div>

                            <!-- Quantity, Update & Remove Buttons -->
                            <div class="col-md-4 d-flex flex-column align-items-end gap-3">
                                <!-- First Row (Remove & Quantity Input) -->
                                <div class="d-flex w-100">
                                    <!-- Remove Button -->
                                    <form action="{{ route('basket.removeItem', $item) }}" method="POST" class="me-3">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill shadow-sm">
                                            Remove
                                        </button>
                                    </form>

                                    <!-- Quantity Input -->
                                    <form action="{{ route('basket.quantity.update', $item) }}" method="POST" class="flex-grow-1">
                                        @csrf
                                        @method("PATCH")
                                        <input 
                                            type="number"
                                            name="quantity"
                                            value="{{ $item->quantity }}"
                                            min="1"
                                            max="{{ $item->productOption->stock }}"
                                            class="form-control form-control-sm rounded-pill border-success shadow-sm"
                                            style="padding: 8px;">
                                    </form>
                                </div>

                                <!-- Second Row (Update Quantity Button) -->
                                <div class="mt-3 w-100">
                                    <button type="submit" class="btn btn-success btn-sm w-100 rounded-pill shadow-sm"
                                        style="background-color: #3b5e3b; border-color: #3b5e3b;">
                                        Update Quantity
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-warning mt-4 rounded-pill px-4 py-3">
                    Your basket is empty!
                </div>
            @endif
        </div>

        <!-- Order Summary -->
        <div class="col-md-4">
            <div class="card shadow-sm border" style="background-color: #fdfde7; border-radius: 30px; border-color: #3b5e3b;">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4" style="color: #3b5e3b;">Order Summary</h4>

                    @if($basket->items->count() > 0)
                        <ul class="list-group mb-4 border-0">
                            <li class="list-group-item d-flex justify-content-between border-0 bg-transparent">
                                <span>Subtotal</span>
                                <strong>£{{ number_format($basket->total / 1.20, 2) }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between border-0 bg-transparent">
                                <span>Shipping</span>
                                <strong>
                                    @if($subtotal < 30.01)
                                        £{{ number_format($shipping, 2) }}
                                    @else
                                        £0
                                    @endif
                                </strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between border-0 bg-transparent">
                                <span>V.A.T</span>
                                <strong>£{{ number_format(((($basket->total) * 0.20) / 1.20), 2) }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between border-0 bg-transparent">
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

                        <a href="{{ route('checkout.index') }}" class="btn btn-success w-100 rounded-pill py-3 fw-semibold shadow-sm"
                            style="background-color: #3b5e3b; border-color: #3b5e3b;">
                            Continue to Checkout →
                        </a>
                    @else
                        <p class="text-muted text-center mt-4">You can’t checkout with an empty basket!</p>
                        <button class="btn btn-secondary w-100 rounded-pill py-3" disabled>Checkout</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>

@include('components.newfooter')

</x-newheader>
