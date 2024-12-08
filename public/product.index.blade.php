@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Our Products</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ route('product.search') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search products..." value="{{ request('q') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <!-- Product List -->
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset($product['image']) }}" class="card-img-top" alt="{{ $product['name'] }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product['name'] }}</h5>
                    <p class="card-text">{{ $product['label'] }}</p>
                    <p class="card-text"><strong>Price:</strong> ${{ $product['price'] }}</p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ url('products/' . strtolower(str_replace(' ', '', $product['name']))) }}" class="btn btn-outline-primary">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
