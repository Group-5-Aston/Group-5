<x-newheader>

    <title>Admin Dashboard</title>
    <style>
        .dashboard-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .grid-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            width: 100%;
        }

        .dashboard-item {
            width: 250px;
            padding: 20px;
            font-size: 18px;
            font-weight: bold;
            background: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .dashboard-item button {
            display: block;
            background-color: #4a6425;
            color: white;
            border: none;
            padding: 12px;
            margin: 8px 0;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            width: 100%;
            border-radius: 5px;
        }

        .dashboard-item button:hover {
            background-color: #3b511f;
        }

        .search-box {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            width: 200px;
        }

        h2 {
            color: #4a6425;
            text-align: center;
        }
    </style>

    <div class="heading_container heading_center" style="padding-top:48px; display: flex; flex-direction: column; align-items: center;">
        <h2>Admin Dashboard</h2>
        <input type="text" id="search" placeholder="Search Task" autocomplete="off" class="search-box" style="margin-top: 10px;">
    </div>

    @if(request('message'))
        <div class="alert alert-warning" style="text-align: center;">
            {{ request('message') }}
        </div>
    @endif

    <div class="dashboard-container">
        <div class="grid-container">
            <div class="dashboard-item">
                <h4>Customers</h4>
                <button onclick="location.href='/admin/customers'">Manage Customers</button>
            </div>

            <div class="dashboard-item">
                <h4>Inventory</h4>
                <button onclick="location.href='/admin/inventory'">View Inventory</button>
                <button onclick="location.href='/admin/inventory/newproduct'">Add New Product</button>
            </div>

            <div class="dashboard-item">
                <h4>Orders</h4>
                <button onclick="location.href='/admin/orders'">View Orders</button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('keyup', function () {
            let searchValue = this.value.toLowerCase();
            let items = document.querySelectorAll('.dashboard-item');
            items.forEach(item => {
                let text = item.innerText.toLowerCase();
                item.style.display = text.includes(searchValue) ? 'block' : 'none';
            });
        });
    </script>

<h1>Welcome, {{auth()->user()->name}}</h1>

<h2>Low Stock Products</h2>

<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Size</th>
        <th>Flavour</th>
        <th>Stock</th>
    </tr>
    </thead>
    <tbody id="productTable">
    @if(isset($lowStockOptions) && $lowStockOptions->count() > 0)
        @foreach($lowStockOptions as $option)
            <tr class="clickable" data-href="{{ route('adminproduct.show', $option->product) }}">
                <td>{{ $option->product->name }} </td>
                <td>{{ $option->size }}</td>
                <td>{{ $option->flavor }}</td>
                <td>{{ $option->stock }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="8">Nothing low in stock, great!</td>
        </tr>
    @endif
    </tbody>
</table>

<h2>Pending Orders</h2>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>User Name</th>
        <th>Total Price</th>
        <th>Created At</th>
    </tr>
    </thead>
    <tbody id="orderTable">
    @if(isset($pendingOrders) && $pendingOrders->count() > 0 )
        @foreach($pendingOrders as $order)
            <tr class="clickable" data-href="{{route('adminorder.show', ['order' => $order->order_id])}}">
                <td>{{ $order->order_id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->total }}</td>
                <td>{{ $order->created_at }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="8">No pending orders.</td>
        </tr>
    @endif
    </tbody>
</table>

<h2>Returns awaiting approval</h2>

<table>
    <thead>
    <tr>
        <th>Order ID</th>
        <th>Name</th>
        <th>Refund Amount</th>
        <th>Received At</th>
    </tr>
    </thead>
    <tbody id="returnTable">
    @if(isset($pendingReturns) && $pendingReturns->count() > 0)
        @foreach($pendingReturns as $item)
            <tr class="clickable" data-href="{{route('adminorder.show', ['order' => $item->order->order_id])}}">
                <td>{{ $item->order->order_id }}</td>
                <td>{{ $item->orderItem->name }}</td>
                <td>{{ $item->total }}</td>
                <td>{{ $item->updated_at }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="8">No returns received.</td>
        </tr>
    @endif
    </tbody>
</table>

<h2>Notifications</h2>
@if(isset($notifications) && $notifications->count() > 0)
    @foreach($notifications as $notification)
            <a href="{{$notification->data['url']}}">
                <h4>{{$notification->data['subject']}}</h4>
                <p>{{$notification->data['message']}}</p>
                <small>{{ $notification->created_at->shortAbsoluteDiffForHumans() }}</small>
            </a>
    @endforeach
    @else
        <p>No notifications</p>
@endif


<script>
//Script to make each row of the table clickable
    document.querySelectorAll('.clickable').forEach(row => {
        row.addEventListener('click', function () {
            window.location.href = this.dataset.href;
        });
    });
</script>


    @include('components.newcompactfooter')

</x-newheader>
