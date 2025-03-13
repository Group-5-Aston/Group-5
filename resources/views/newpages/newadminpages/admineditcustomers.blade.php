
<p>User ID: {{$user->id}}</p>

<x-alert type="success" :message="session('success')" />
<x-alert type="error" :message="session('error')" />


@if($user->usertype === 'admin')
    <p>You cannot edit an admin.</p>
@elseif($user->order()->whereNot('Orders.status', 'complete')->exists())
    <p>You cannot delete a user with an active order/return.
@endif

@if(session('status'))
    <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" role="alert" style="z-index: 1050; min-width: 300px; max-width: 600px;">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('adminprofile.edit', ['user' => $user->id] )}}">
    @csrf
    @method('PATCH')
    <fieldset @if($user->usertype === 'admin') disabled @endif>
        <input type="text" name="name" value="{{$user->name}}">
        <input type="text" name="email" value="{{$user->email}}">
        <input type="text" name="phone" value="{{$user->phone}}">
        <input type="text" name="address" value="{{$user->address}}">
        <input type="submit" value="edit">
    </fieldset>
</form>



<form method="POST" action="{{ route('adminprofile.destroy', ['user'=>$user->id]) }}">
    @csrf
    @method('DELETE')
    <fieldset @if($user->usertype === 'admin'
    || $user->returnItems()->whereNot('returns.status', 'refunded')->exists()
    || $user->order()->whereNot('Orders.status', 'complete')->exists()) disabled @endif>
        <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')">
            Delete User
        </button>
    </fieldset>
</form>
<h1>Orders</h1>
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

<script>
//Script to make each row of the table clickable
    document.querySelectorAll('.clickable').forEach(row => {
        row.addEventListener('click', function () {
            window.location.href = this.dataset.href;
    });
});
</script>
