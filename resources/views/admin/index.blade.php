<x-newheader>
    
    <title>Admin Dashboard</title>
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
            text-align: center;
        }

        .dashboard-item {
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
        }

        .dashboard-item button {
            display: block;
            background-color: #4a6425;
            color: white;
            border: none;
            padding: 10px;
            margin: 5px 0;
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
            text-align: center;
            color: #4a6425;
            margin-bottom: 20px;
        }
    </style>

<body>
    <div class="heading_container heading_center" style="padding-top:48px; margin-left: 200px; display: flex; justify-content: space-between; align-items: center; width: 80%;">
        <h3>Admin Dashboard</h3>
        <input type="text" id="search" placeholder="Search Task" autocomplete="off" class="search-box">
    </div>

    @if(request('message'))
        <div class="alert alert-warning">
            {{ request('message') }}
        </div>
    @endif

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

        <div class="dashboard-item">
            <h4>Refunds</h4>
            <button onclick="location.href='/admin/order/{returnItem}/confirm'">Confirm Refund</button>
            <button onclick="location.href='/admin/order/{returnItem}/reject'">Reject Refund</button>
        </div>

        <div class="dashboard-item">
            <h4>Product Management</h4>
            <button onclick="location.href='/admin/inventory/{product}'">View Product</button>
            <button onclick="location.href='/admin/inventory/{product}/image'">Change Image</button>
            <button onclick="location.href='/admin/inventory/{product}/edit'">Edit Product</button>
            <button onclick="location.href='/admin/inventory/{product}/delete'">Delete Product</button>
        </div>

        <div class="dashboard-item">
            <h4>Stock Options</h4>
            <button onclick="location.href='/admin/inventory/{option}/option'">Edit Stock</button>
            <button onclick="location.href='/admin/inventory/{product}/option/add'">Add Stock Option</button>
            <button onclick="location.href='/admin/inventory/{option}/option/delete'">Delete Stock Option</button>
        </div>

        <div class="dashboard-item">
            <h4>Order Management</h4>
            <button onclick="location.href='/admin/order/{order}'">View Order</button>
            <button onclick="location.href='/admin/order/{order}/message'">Update Message</button>
            <button onclick="location.href='/admin/order/{order}/process'">Process Order</button>
            <button onclick="location.href='/admin/order/{order}/cancel'">Cancel Order</button>
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
</body>

@include('components.newcompactfooter')
</x-newheader>
