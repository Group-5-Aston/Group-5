@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Products</h1>
        <form method="get" action="{{ route('product.search') }}">
            <input type="text" name="q" placeholder="Search products...">
            <button type="submit">Search</button>
        </form>

        @if (isset($products->links()))
            {{ $products->links() }}
        @endif

        @foreach ($products as $product)
            <div class="card">
                <h2>{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>
                <p>Price: {{ $product->price }}</p>
                <a href="{{ route('product.show', $product->id) }}">View product</a>
            </div>
        @endforeach
    </div>
@endsection
