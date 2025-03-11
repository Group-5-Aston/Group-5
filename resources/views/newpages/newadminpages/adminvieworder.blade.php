<h1>Order #{{ $order->order_id }}</h1>

<p>User id: {{ $order->user_id }}</p>
<p>User name: {{ $order->user->name }}</p>
<p>Shipping address: {{ $order->address }}</p>
<br>
<p>Subtotal: £{{$subtotal}}</p>
<p>VAT: £{{$vat}}</p>
<p>Shipping: {{$shipping}}</p>
<p>Total: £{{$order->total}}</p>
<br>
<p>Status: {{ $order->getOrderStatus() }}</p>

<form method="POST" action="{{ route('adminordermessage.update', $order) }}">
    @csrf
    @method('PATCH')
    <textarea rows="5" name="message" cols="50" placeholder="Leave a message for customer about the order" required>{{$order->message}}</textarea> <br>
    <input type="submit" value="Update message">
</form>

<h2>Items</h2>

<table>
    <thead>
    <tr>
        <th>Order Item ID</th>
        <th>Name</th>
        <th>Option ID</th>
        <th>Quantity</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody id="productTable">
    @if(isset($orderItems) && $orderItems->count() > 0)
        @foreach($orderItems as $item)
            {{--Gives every row a link to the product, if there is no product then redirect to the inventory --}}
            <tr class="clickable" data-href="{{ optional(optional($item->productOption)->product)
                ? route('adminproduct.show', optional($item->productOption)->product)
                : route('admin.inventory',['message' => 'That product no longer exists'])
            }}">
                <td>{{ $item->order_item_id }}</td>
                <td>{{ $item->name}}</td>
                <td>{{ $item->option_id }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->total }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="8">No products found.</td>
        </tr>
    @endif
    </tbody>
</table>

<form method="POST" action="{{ route('adminorder.process', $order) }}">
    @csrf
    @method('PATCH')
    <input type="hidden" name="process" value="process">
    <button type="submit" {{$order->status != 'pending' ? 'disabled' : '' }}>Process Order</button>
</form>

<form method="POST" action="{{ route('adminorder.cancel', $order) }}">
    @csrf
    @method('PATCH')
    <input type="hidden" name="cancel" value="cancel">
    <button type="submit" {{$order->status != 'pending' ? 'disabled' : '' }}>Cancel Order</button>
</form>

@if($order->status == 'returned')
    <h2>Returned items</h2>
    <table>
        <thead>
        <tr>
            <th>Return ID</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Refund Amount</th>
            <th>Reason</th>
            <th>Status</th>
            <th>Requested At</th>
            <th>Updated At</th>
        </tr>
        </thead>
        <tbody id="productTable">
        @if(isset($returnItems) && $returnItems->count() > 0)
            @foreach($returnItems as $item)
                <tr>
                    <td>{{ $item->return_id }}</td>
                    <td>{{ $item->orderItem->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->total }}</td>
                    <td>{{ $item->reason }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td>
                        <form method="POST" action="{{route('adminrefund.confirm', ['returnItem' => $item->return_id]) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="confirm" value="confirm">
                            <button type="submit" {{$item->status != 'returned' ? 'disabled' : '' }}>Confirm Refund</button>
                        </form>
                        <form method="POST" action="{{route('adminrefund.reject', ['returnItem' => $item->return_id]) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="reject" value="reject">
                            <button type="submit" {{$item->status != 'returned' ? 'disabled' : '' }}>Reject Refund</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">No products found.</td>
            </tr>
        @endif
        </tbody>
    </table>
@endif

<script>
//Script to make each row of the table clickable
    document.querySelectorAll('.clickable').forEach(row => {
        row.addEventListener('click', function () {
            window.location.href = this.dataset.href;
        });
    });
</script>
