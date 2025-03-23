<x-newheader>
    <title>Your Orders</title>
    <style>
        .order-container {
            max-width: 1200px;
            margin: auto;
            padding: 0px 20px 20px 20px;
        }

        .order-card {
            background: #fdfde7;
            border: 1px solid #4B7C47;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .order-card h3 {
            color: #4B7C47;
        }

        .order-card p {
            margin: 5px 0;
        }

        .order-items {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 10px 0;
        }

        .order-item {
            background: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            flex: 1 1 200px;
        }

        .order-item img {
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .order-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 15px;
        }

        .order-buttons a:disabled {
            background-color: #A3B8A1;
            cursor: default;
        }


        .order-buttons button, .order-buttons a {
            background-color: #4B7C47;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 30px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease-in-out;
        }

        .order-buttons button:hover, .order-buttons a:hover {
            background-color: #3b511f;
        }

        .order-buttons button:disabled {
            background-color: #A3B8A1;
            cursor: default;
        }
    </style>

    <div class="order-container">
        <h1>Your Orders</h1>

        @include('components.validation-alert')


        @if(isset($orders) && $orders->count() > 0)
            @foreach($orders as $order)
                <div class="order-card">
                    <h3>Order #{{ $order->order_id }}</h3>
                    <p><strong>Order Date:</strong> {{$order->created_at}}</p>
                    <p><strong>Total:</strong> £{{$order->calculateTotal()}} ({{$order->orderItems->count()}} item(s))
                    </p>
                    <p><strong>Delivery Time:</strong> {{$order->deliveryTime() }}</p>


                    @if(isset($order->orderItems) && $order->orderItems->count() > 0)
                        <div class="order-items">
                            @foreach($order->orderItems as $item)
                                <div class="order-item">
                                    <img src="{{Storage::url($item->image)}}" height="120" width="120"
                                         alt="Product image">
                                    <h5>{{$item->nameSizeFlavour()}}</h5>
                                    <small>Quantity: {{$item->quantity}}</small>
                                    <p><strong>£{{$item->total}}</strong></p>
                                    <div class="order-buttons">
                                        @if($order->status == 'complete' || $order->status == 'returned')
                                            <a href="{{route('order.return', $item, $order)}}">Make a Return</a>
                                            <a href="{{route('review.index', $item)}}">Leave a Review</a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{route('order.cancel', $order)}}" class="order-buttons">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                                {{ $order->status != 'pending' ? 'disabled' : '' }} onclick="return confirm('Are you sure you wish to cancel this order? If so you will be refunded in at least 2 business days')">
                            Cancel Order
                        </button>
                    </form>
                </div>
            @endforeach
        @endif
    </div>

    @include('components.newfooter')
</x-newheader>
