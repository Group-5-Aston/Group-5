<x-newheader>

    <x-alert type="success" :message="session('success')"/>
    <x-alert type="error" :message="session('error')"/>

    <div class="container2">
        <h2>User# {{$user->id}}</h2>


        @if($user->usertype === 'admin')
            <p>You cannot edit an admin.</p>
        @elseif($user->order()->whereNot('Orders.status', 'complete')->exists())
            <p>You cannot delete a user with an active order/return.
        @endif

        <form method="POST" id="editForm" action="{{ route('adminprofile.edit', ['user' => $user->id] )}}">
            @csrf
            @method('PATCH')
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" value="{{$user->name}}">
            <label for="email">Email:</label>
            <input type="text" name="email" class="form-control" value="{{$user->email}}">
            <label for="phone">Phone:</label>
            <input type="text" name="phone" class="form-control" value="{{$user->phone}}">
            <label for="address">Address:</label>
            <input type="text" name="address" class="form-control" value="{{$user->address}}">
        </form>

        <div class="buttons">
        <button type="button" class="filter-btn" onclick="document.getElementById('editForm').submit();">
            Edit
        </button>

        <form method="POST" action="{{ route('adminprofile.destroy', ['user'=>$user->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn" {{($user->usertype === 'admin'
    || $user->returnItems()->whereNot('returns.status', 'refunded')->exists()
    || $user->order()->whereNot('Orders.status', 'complete')->exists()) ? 'disabled' : ''}} onclick="return confirm('Are you sure you want to delete this user?')">
                Delete User
            </button>
        </form>
        </div>



    <h1 style="padding-top: 20px;">Orders</h1>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Total Price</th>
            <th>Address</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        </thead>
        <tbody id="orderTable">
        @if(isset($user->order) && $user->order->count() > 0)
            @foreach($user->order as $order)
                <tr class="clickable" data-href="{{route('adminorder.show', ['order' => $order->order_id])}}">
                    <td>{{ $order->order_id }}</td>
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
    </div>

    <script>
        //Script to make each row of the table clickable
        document.querySelectorAll('.clickable').forEach(row => {
            row.addEventListener('click', function () {
                window.location.href = this.dataset.href;
            });
        });
    </script>

    <style>
        .container2 {
            width: 50%;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .delete-btn {
            background-color: red;
            color: white;
            border-radius: 30px;
            border: none;
            padding: 9px 20px;
            transition: background-color 0.3s ease-in-out;

        }


        .delete-btn:hover {
            background-color: darkred;
        }

        .delete-btn:disabled {
            background-color: lightgrey;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }

        .clickable:hover {
            background-color: #f8f8f8;
            cursor: pointer;
        }

    </style>

    @include('components.newcompactfooter')

</x-newheader>
