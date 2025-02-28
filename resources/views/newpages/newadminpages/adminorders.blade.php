<h1>List of Orders</h1>

<!-- search bar -->
<input type="text" id="search" placeholder="Search by name or status" autocomplete="off">

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>User ID</th>
        <th>User Name</th>
        <th>Total Price</th>
        <th>Address</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Updated At</th>
    </tr>
    </thead>
    <tbody id="orderTable">
    @if(isset($orders) && $orders->count() > 0)
        @foreach($orders as $order)
            <tr class="clickable" data-href="{{route('adminorder.show', ['order' => $order->order_id])}}">
                <td>{{ $order->order_id }}</td>
                <td>{{ $order->user_id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->total }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->updated_at }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="8">No orders found.</td>
        </tr>
    @endif
    </tbody>
</table>

<script>
    //Script for live search
    document.getElementById('search').addEventListener('keyup', function () {
        let searchValue = this.value;

        fetch(`{{ route('admin.orders') }}?search=${encodeURIComponent(searchValue)}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.json())
            .then(data => {
                let tableRows = '';

                data.orders.forEach(order => {
                    tableRows += `
                        <tr class="clickable" data-href="${order.order_url}">
                            <td>${order.order_id}</td>
                            <td>${order.user_id}</td>
                            <td>${order.name}</td>
                            <td>${order.total}</td>
                            <td>${order.address}</td>
                            <td>${order.status}</td>
                            <td>${order.created_at}</td>
                            <td>${order.updated_at}</td>
                        </tr>
                    `;
                });

                document.getElementById('orderTable').innerHTML = tableRows;

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
