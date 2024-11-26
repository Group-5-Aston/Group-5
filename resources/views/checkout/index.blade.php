@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $productId => $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>${{ $item['price'] }}</td>
                    <td>${{ $item['price'] * $item['quantity'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total: ${{ $total }}</h3>

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <input type="hidden" name="total" value="{{ $total }}">
        <button type="submit" class="btn btn-success">Place Order</button>
    </form>
</div>
@endsection
