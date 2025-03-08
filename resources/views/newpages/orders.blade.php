<x-newheader>
    <h1>Your orders</h1>
    @if(isset($orders) && $orders->count() > 0)
        @foreach($orders as $order)
            <div class="card mb-3 shadow-sm">
                <h3>Order #{{ $order->order_id }}</h3>
                <p>Order date: {{$order->created_at}}</p>
                <p>Order total: {{$order->calculateTotal()}} ({{$order->orderItems->count()}} item(s)) </p>
                <p>{{$order->deliveryTime() }}</p>
                <p>{{$order->message ? 'Message: ' . $order->message : ''}}</p>

                <!-- Order items -->
                @if(isset($order->orderItems) && $order->orderItems->count() > 0)
                    @foreach($order->orderItems as $item)
                        <p>Image goes here</p>
                        <h5> {{$item->name}} {{$item->size ? ', '. $item->size : '' }} {{$item->flavor ? ', ' . $item->flavor : ''}} </h5>
                        <small>Quantity: {{$item->quantity}}</small>
                        <p>£{{$item->total}}</p>
                        <a href="">Make a return</a>
                        <a href="">Leave a review</a>
                        ----------------------------
                    @endforeach
                @endif

                <form method="POST" action="{{route('order.cancel', $order)}}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" {{ $order->status != 'pending' ? 'disabled' : '' }} onclick="return confirm('Are you sure you wish to cancel this order? If so you will be refunded in at least 2 business days')" >
                        Cancel order
                    </button>
                </form>
            </div>
        @endforeach
    @endif
    @include('components.newfooter')
</x-newheader>
