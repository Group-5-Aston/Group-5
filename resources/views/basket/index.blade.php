<x-newheader>

<main class="container pb-5" style="padding-top: 0;">
    <!-- Alerts with no top gap -->
    <x-alert type="success" :message="session('success')" />
    <x-alert type="error" :message="session('error')" />

    <div class="row">
        <!-- Basket Items Section -->
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="display-5 fw-semibold" style="color: #3b5e3b;">Your Basket</h1>
                <a href="{{ route('filter.page') }}" class="btn btn-outline-success rounded-pill px-4 py-2"
                   style="border-color: #3b5e3b; color: #3b5e3b;">
                    Continue Shopping
                </a>
            </div>

            @if($basket->items->count() > 0)
                @foreach($basket->items as $item)
                    <!-- Basket Product Card -->
                    <div class="basket-product-card mb-4">
                        <div class="row g-0 align-items-center p-4">
                            <!-- Product Image -->
                            <div class="col-md-3">
                                <img
                                    src="{{ Storage::url($item->productOption->product->image ?? 'placeholder.png') }}"
                                    alt="{{ $item->productOption->product->name ?? 'Product' }}"
                                    class="basket-product-image"
                                >
                            </div>

                            <!-- Item Details -->
                            <div class="col-md-5">
                                <div class="card-body p-0">
                                    <h5 class="basket-product-title">
                                        {{ $item->productOption->product->name }}
                                    </h5>

                                    @if($item->productOption->flavor)
                                        <p class="basket-product-text text-muted mb-2">
                                            <strong>Flavor:</strong> {{ $item->productOption->flavor }}
                                        </p>
                                    @endif

                                    @if($item->productOption->size)
                                        <p class="basket-product-text text-muted mb-2">
                                            <strong>Size:</strong> {{ $item->productOption->size }}
                                        </p>
                                    @endif

                                    <p class="basket-product-text text-muted mb-2">
                                        <strong>Quantity:</strong> {{ $item->quantity }}
                                    </p>

                                    <p class="basket-product-price">
                                        £{{ number_format($item->price, 2) }}
                                    </p>
                                </div>
                            </div>

                            <!-- Quantity, Update & Remove Buttons -->
                            <div class="col-md-4 d-flex flex-column align-items-end gap-3">
                                <div class="d-flex w-100 gap-3">
                                    <!-- Remove Button -->
                                    <div class="w-50">
                                        <form action="{{ route('basket.removeItem', $item) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill shadow-sm w-100">
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                    <!-- Quantity Input Form -->
                                    <div class="w-50">
                                        <form action="{{ route('basket.quantity.update', $item) }}"
                                              method="POST"
                                              id="update-form-{{ $item->id }}">
                                            @csrf
                                            @method("PATCH")
                                            <input 
                                                type="number"
                                                name="quantity"
                                                value="{{ $item->quantity }}"
                                                min="1"
                                                max="{{ $item->productOption->stock }}"
                                                class="form-control form-control-sm rounded-pill border-success shadow-sm w-100"
                                                style="padding: 8px;"
                                            >
                                        </form>
                                    </div>
                                </div>

                                <!-- Separate row for Update Quantity button, referencing above form -->
                                <div class="mt-3 w-100">
                                    <button 
                                        type="submit" 
                                        form="update-form-{{ $item->id }}" 
                                        class="btn btn-success btn-sm w-100 rounded-pill shadow-sm"
                                        style="background-color: #3b5e3b; border-color: #3b5e3b;"
                                    >
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
            <div class="card shadow-sm border basket-summary-card">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4 basket-summary-title">Order Summary</h4>

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

<style>
/* Basket Product Card: matches shop design, adapted for the basket layout */
.basket-product-card {
  background-color: #fdfde7;
  border: 1px solid #3b5e3b;
  border-radius: 30px;
  box-shadow: 0 4px 12px rgba(77, 122, 46, 0.08);
  transition: all 0.4s ease;
}

.basket-product-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 20px rgba(77, 122, 46, 0.15);
  border-color: #4d7a2e;
}

/* Basket Product Image */
.basket-product-image {
  width: 100%;
  max-height: 140px;
  object-fit: cover;
  border-radius: 12px;
  box-shadow: 0 3px 8px rgba(0,0,0,0.05);
  background-color: #fff; /* White background */
  padding: 5px;
}

/* Basket Product Info */
.basket-product-title {
  color: #3b5e3b;
  font-weight: 600;
  font-size: 1.15rem;
  margin-bottom: 10px;
  transition: color 0.3s ease;
}

.basket-product-card:hover .basket-product-title {
  color: #4d7a2e;
}

.basket-product-text {
  color: #555;
  font-size: 0.9rem;
}

.basket-product-price {
  font-size: 1.25rem;
  font-weight: 700;
  color: #3b5e3b;
}

/* Basket Summary Card */
.basket-summary-card {
  background-color: #fdfde7;
  border-radius: 30px;
  border-color: #3b5e3b;
}

.basket-summary-title {
  color: #3b5e3b;
}
</style>

</x-newheader>

