<?php
<form method="GET" action="{{ route('product.filter') }}">
    @foreach($categories as $category)

    ?>

        <div class="filter-option">
            <input type="radio" name="category" value="{{ $category->id }}" {{ $selectedCategory === $category->id
? 'checked' : '' }}>
            <label for="{{ $category->id }}">{{ $category->name }}</label>
        </div>
    @endforeach

    <button type="submit">Filter</button>
</form>

@if (isset($products))
    @foreach ($products as $product)
        <div class="product-card">
            <h2>{{ $product->name }}</h2>
            <p>{{ $product->description }}</p>
            <p>Price: {{ $product->price }}</p>
            <a href="{{ route('product.show', $product->id) }}">View product</a>
        </div>
    @endforeach
@endif

