<h1>Inventory</h1>


<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Label</th>
        <th>Is food</th>
        <th>Is toy or bed</th>
    </tr>
    </thead>
    <tbody id="userTable">
    @if(isset($products) && $products->count() > 0)
        @foreach($products as $product)
            <tr class="clickable" data-href="{{ route('profile.show', $product) }}">
                <td>{{ $product->product_id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->label }}</td>
                <td>{{ $product->is_food }}</td>
                <td>{{ $product->is_toy_or_bed }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="8">No products found.</td>
        </tr>
    @endif
    </tbody>
</table>
