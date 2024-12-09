@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Shop</h1>
    <div class="row">
        @foreach($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card">
                <img src="/images/{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">£{{ $product->price }}</p>
                    <a href="{{ route('shop.show', $product->id) }}" class="btn btn-primary">View Product</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

