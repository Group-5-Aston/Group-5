<h1>Inventory</h1>

<input type="text" id="search" placeholder="Search by name" autocomplete="off">

@if(request('message'))
    <div class="alert alert-warning">
        {{ request('message') }}
    </div>
@endif

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
    <tbody id="productTable">
    @if(isset($products) && $products->count() > 0)
        @foreach($products as $product)
            <tr class="clickable" data-href="{{ route('adminproduct.show', $product) }}">
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

<a href="{{ route('adminaddproduct.show') }}">Add a new product</a>

<script>
    //Script for live search
    document.getElementById('search').addEventListener('keyup', function () {
        let searchValue = this.value;

        fetch(`{{ route('admin.inventory') }}?search=${encodeURIComponent(searchValue)}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.json())
            .then(data => {
                let tableRows = '';

                data.products.forEach(product => {
                    tableRows += `
                    <tr class="clickable" data-href="${product.product_url}">
                        <td>${product.product_id}</td>
                        <td>${product.name}</td>
                        <td>${product.price}</td>
                        <td>${product.label}</td>
                        <td>${product.is_food}</td>
                        <td>${product.is_toy_or_bed}</td>
                    </tr>
                `;
                });

                document.getElementById('productTable').innerHTML = tableRows;

                document.querySelectorAll('.clickable').forEach(row => {
                    row.addEventListener('click', function () {
                        window.location.href = this.dataset.href;
                    });
                });
            })
            .catch(error => console.error('Error:', error));
    });

    //Script to make each row of the table clickable
    document.querySelectorAll('.clickable').forEach(row => {
        row.addEventListener('click', function () {
            window.location.href = this.dataset.href;
        });
    });
</script>
