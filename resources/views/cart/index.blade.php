@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Cart</h1>
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="py-2 px-4 text-left">Product</th>
                                <th class="py-2 px-4 text-left">Price</th>
                                <th class="py-2 px-4 text-left">Quantity</th>
                                <th class="py-2 px-4 text-left">Total</th>
                                <th class="py-2 px-4 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $id => $item)
                                <tr class="border-b">
                                    <td class="py-4 px-4">{{ $item['name'] }}</td>
                                    <td class="py-4 px-4">{{ $item['price'] }}</td>
                                    <td class="py-4 px-4">
                                        <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $id }}">
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" class="border rounded px-2 py-1 mr-2 w-24">
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Update</button>
                                        </form>
                                    </td>
                                    <td class="py-4 px-4">{{ $item['price'] * $item['quantity'] }}</td>
                                    <td class="py-4 px-4">
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $id }}">
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-6">
                        <h2 class="text-xl font-bold mb-2">Order Summary</h2>
                        <p class="mb-2">Subtotal: {{ $cart->total() }}</p>
                        <p class="mb-2">Shipping: {{ $cart->shipping() }}</p>
                        <p class="mb-4">Total: {{ $cart->total() + $cart->shipping() }}</p>
                        <a href="{{ route('checkout') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection