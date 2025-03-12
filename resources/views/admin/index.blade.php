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

        .dashboard-item a {
            display: block;
            text-decoration: none;
            color: #4a6425; /* Dark green */
            padding: 10px;
            font-size: 16px;
            transition: color 0.3s ease-in-out;
        }

        .dashboard-item a:hover {
            color: #3b511f; /* Slightly darker green on hover */
        }

        /* Search Bar Styling */
        .search-box {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            width: 200px; /* Adjust width as needed */
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
        <!-- Dashboard Links -->
        <div class="dashboard-item">
            <a href="/admin/customers">Manage Customers</a>
        </div>

        <div class="dashboard-item">
            <a href="/admin/inventory">View Inventory</a>
            <a href="/admin/inventory/newproduct">Add New Product</a>
        </div>

        <div class="dashboard-item">
            <a href="/admin/orders">View Orders</a>
        </div>

        <div class="dashboard-item">
            <a href="/admin/order/{returnItem}/confirm">Confirm Refund</a>
            <a href="/admin/order/{returnItem}/reject">Reject Refund</a>
        </div>

        <div class="dashboard-item">
            <a href="/admin/inventory/{product}">View Product</a>
            <a href="/admin/inventory/{product}/image">Change Image</a>
            <a href="/admin/inventory/{product}/edit">Edit Product</a>
            <a href="/admin/inventory/{product}/delete">Delete Product</a>
        </div>

        <div class="dashboard-item">
            <a href="/admin/inventory/{option}/option">Edit Stock</a>
            <a href="/admin/inventory/{product}/option/add">Add Stock Option</a>
            <a href="/admin/inventory/{option}/option/delete">Delete Stock Option</a>
        </div>

        <div class="dashboard-item">
            <a href="/admin/order/{order}">View Order</a>
            <a href="/admin/order/{order}/message">Update Message</a>
            <a href="/admin/order/{order}/process">Process Order</a>
            <a href="/admin/order/{order}/cancel">Cancel Order</a>
        </div>
    </div>

    <script>
        // Script for live search
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