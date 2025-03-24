<x-newheader>

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
        margin: 8px 0;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
        width: 100%;
    }

    .dashboard-item button:hover {
        background-color: #4B7C47;
    }

    .search-box {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        width: 200px;
    }

    h2 {
        text-align: center;
    }

    table {
        width: 90%;
        margin: 20px auto;
        border-collapse: collapse;
    }

    thead {
        background-color: #4B7C47;
        color: white;
    }

    tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tbody tr:nth-child(odd) {
        background-color: #fffbe6;
    }

    th, td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .clickable:hover {
        background-color: #e6f0d4;
        cursor: pointer;
    }

    .notification-box {
        background: #f8f8f8;
        border: 1px solid #ccc;
        padding: 15px;
        border-radius: 10px;
        width: 90%;
        margin: 10px auto;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        color: black;
        text-decoration: none;
    }

    .notification-box h4 {
        margin: 0 0 5px;
        color: #4B7C47;
    }

    .notification-box p {
        margin: 0 0 5px;
    }

    .notification-box small {
        color: gray;
    }
</style>

<div class="heading_container heading_center" style="display: flex; flex-direction: column; align-items: center;">
    <h2>Admin Dashboard</h2>
    <input type="text" id="search" class="form-control" placeholder="Search Task" autocomplete="off" style="width: 20%; margin-top: 10px;">
</div>

@if(request('message'))
    <div class="alert alert-warning" style="text-align: center;">
        {{ request('message') }}
    </div>
@endif

<div class="dashboard-container">
    <div class="grid-container">
        <div class="dashboard-item">
            <h4 style="color:#426b1f">Customers</h4>
            <button class="filter-btn" onclick="location.href='/admin/customers'">Manage Customers</button>
        </div>

        <div class="dashboard-item">
            <h4 style="color:#426b1f">Inventory</h4>
            <button class="filter-btn" onclick="location.href='/admin/inventory' ">View Inventory</button>
            <button class="filter-btn" onclick="location.href='/admin/inventory/newproduct'">Add New Product</button>
        </div>

        <div class="dashboard-item">
            <h4 style="color:#426b1f">Orders</h4>
            <button class="filter-btn" onclick="location.href='/admin/orders'">View Orders</button>
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

<p></p>
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
    <tbody>
    @foreach($lowStockOptions ?? [] as $option)
        <tr class="clickable" data-href="{{ route('adminproduct.show', $option->product) }}">
            <td>{{ $option->product->name }}</td>
            <td>{{ $option->size }}</td>
            <td>{{ $option->flavor }}</td>
            <td>{{ $option->stock }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<p></p>
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
    <tbody>
    @foreach($pendingOrders ?? [] as $order)
        <tr class="clickable" data-href="{{route('adminorder.show', ['order' => $order->order_id])}}">
            <td>{{ $order->order_id }}</td>
            <td>{{ $order->user->name }}</td>
            <td>{{ $order->total }}</td>
            <td>{{ $order->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<p></p>
<h2>Returns Awaiting Approval</h2>
<table>
    <thead>
    <tr>
        <th>Order ID</th>
        <th>Name</th>
        <th>Refund Amount</th>
        <th>Received At</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pendingReturns ?? [] as $item)
        <tr class="clickable" data-href="{{route('adminorder.show', ['order' => $item->order->order_id])}}">
            <td>{{ $item->order->order_id }}</td>
            <td>{{ $item->orderItem->name }}</td>
            <td>{{ $item->total }}</td>
            <td>{{ $item->updated_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<p></p>
<h2>Notifications</h2>
@if(isset($notifications) && $notifications->count() > 0)
    @foreach($notifications as $notification)
        <div class="notification-box">
            <a href="{{$notification->data['url']}}" style="text-decoration: none; color: inherit;">
                <h4>{{$notification->data['subject']}}</h4>
                <p>{{$notification->data['message']}}</p>
                <small>{{ $notification->created_at->shortAbsoluteDiffForHumans() }}</small>
            </a>
        </div>
    @endforeach
@else
    <p style="text-align: center;">No notifications</p>
@endif

@include('components.newcompactfooter')

</x-newheader>
