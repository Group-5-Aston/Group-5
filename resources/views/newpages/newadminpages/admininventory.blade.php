<x-newheader>

<style>

table {
    width: 100%;
    border-collapse: collapse;
    text-align: center;
    font-size: 14px;
}

th, td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}

th {
    background-color: #426b1f;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #ddd;
    cursor: pointer;
}

.button-container {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.search-box {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 15px;
    width: 250px;
    margin-left: 400px;
}

h3 {
    color: #426b1f;
    font-size: 20px;
}

</style>

<div class="heading_container heading_center" style="padding-top:48px; margin-left:650px">
      <h3>Inventory
<input type="text" id="search" placeholder="Search by Product Name" autocomplete="off" class="search-box"> </h3>
</div>

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
        <th>Animal</th>
        <th>Type</th>
    </tr>
    </thead>
    <tbody id="productTable">
    @if(isset($products) && $products->count() > 0)
        @foreach($products as $product)
            <tr class="clickable" data-href="{{ route('adminproduct.show', $product) }}">
                <td>{{ $product->product_id }} </td>
                <td>{{ $product->name }}
                    {!! $product->productOptions->contains(fn($option) => $option->stock < 10)
                        ? '<i class="fa-solid fa-circle-exclamation" style="color: #ff0000;"></i>'
                        : '' !!}
                </td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->label }}</td>
                <td>{{ $product->cat_or_dog }}</td>
                <td>{{ $product->type }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="8">No products found.</td>
        </tr>
    @endif
    </tbody>
</table>

<div class="button-container">
    <a href="{{ route('adminaddproduct.show') }}">Add a new product</a>
</div>

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
                    let warningIcon = product.productOptions.some(option => option.stock < 10)
                        ? '<i class="fa-solid fa-circle-exclamation" style="color: #ff0000;"></i>'
                        : '';

                    tableRows += `
                    <tr class="clickable" data-href="${product.product_url}">
                        <td>${product.product_id}</td>
                        <td>${product.name} ${warningIcon}</td>
                        <td>${product.price}</td>
                        <td>${product.label}</td>
                        <td>${product.cat_or_dog}</td>
                        <td>${product.type}</td>
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

@include('components.newcompactfooter')
</x-newheader>
