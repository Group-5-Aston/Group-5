<h1>Order #{{ $order->order_id }}</h1>

<p>User id: {{ $order->user_id }}</p>
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
        <th>Order ID</th>
        <th>Name</th>
        <th>Option ID</th>
        <th>Quantity</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody id="productTable">
    @if(isset($orderItems) && $orderItems->count() > 0)
        @foreach($orderItems as $item)
            <tr class="clickable" data-href="{{ route('adminproduct.show', $item->productOption->product) }}">
                <td>{{ $item->order_id }}</td>
                <td>{{ $item->productOption->product->name }}</td>
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
@endif
<script>
//Script to make each row of the table clickable
    document.querySelectorAll('.clickable').forEach(row => {
        row.addEventListener('click', function () {
            window.location.href = this.dataset.href;
        });
    });
</script>
