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

        .heading_container {
            margin-bottom: 20px;
            position: relative;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .search-box {
            width: 100%;
            max-width: 300px;
            box-sizing: border-box;
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 0px 0px 10px 10px;
        }

        h2 {
            color: #426b1f;
        }

    </style>

    <div class="heading_container heading_center">
        <h2>List of Orders</h2>
    </div>

    <!-- search bar -->
    <input type="text" id="search" placeholder="Search by name or status" autocomplete="off" class="search-box">

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
    @include('components.newcompactfooter')
</x-newheader>
