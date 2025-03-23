<x-newheader>

    <div class="container2">
        <h2 style="padding-top: 20px;">Order #{{ $order->order_id }}</h2>

        @include('components.validation-alert')


        <div style="margin-top: 20px;">
            <p><strong>User ID:</strong> {{ $order->user_id }}</p>
            <p><strong>User Name:</strong> {{ $order->user->name }}</p>
            <p><strong>Shipping Address:</strong> {{ $order->address }}</p>
        </div>

        <div style="margin-top: 30px;">
            <p><strong>Subtotal:</strong> £{{ $subtotal }}</p>
            <p><strong>VAT:</strong> £{{ $vat }}</p>
            <p><strong>Shipping:</strong> {{ $shipping }}</p>
            <p><strong>Total:</strong> £{{ $order->total }}</p>
        </div>

        <div style="margin-top: 30px;">
            <p><strong>Status:</strong> {{ $order->getOrderStatus() }}</p>

            <form method="POST" action="{{ route('adminordermessage.update', $order) }}">
                @csrf
                @method('PATCH')
                <textarea rows="4" name="message" cols="50" placeholder="Leave a message for the customer" required
                          class="form-control">{{ $order->message }}</textarea>
                <button type="submit" class="filter-btn" style="margin-top: 10px;">Update Message</button>
            </form>
        </div>

        <h3 style="padding-top: 40px;">Items</h3>
        <table class="table">
            <thead>
            <tr>
                <th>Item ID</th>
                <th>Name</th>
                <th>Option ID</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orderItems as $item)
                <tr class="clickable"
                    data-href="{{ optional(optional($item->productOption)->product) ? route('adminproduct.show', optional($item->productOption)->product) : route('admin.inventory', ['message' => 'That product no longer exists']) }}">
                    <td>{{ $item->order_item_id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->option_id }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>£{{ $item->total }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div style="display: flex; gap: 10px; margin-top: 20px;">
            <form method="POST" action="{{ route('adminorder.process', $order) }}">
                @csrf
                @method('PATCH')
                <input type="hidden" name="process" value="process">
                <button type="submit" class="filter-btn" {{ $order->status != 'pending' ? 'disabled' : '' }}>Process
                    Order
                </button>
            </form>

            <form method="POST" action="{{ route('adminorder.cancel', $order) }}">
                @csrf
                @method('PATCH')
                <input type="hidden" name="cancel" value="cancel">
                <button type="submit" class="delete-btn" {{ $order->status != 'pending' ? 'disabled' : '' }}>Cancel
                    Order
                </button>
            </form>
        </div>

        @if($order->status == 'returned')
            <h3 style="padding-top: 40px;">Returned Items</h3>
            <table class="table">
                <thead>
                <tr>
                    <th>Return ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Refund</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Requested</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($returnItems as $item)
                    <tr>
                        <td>{{ $item->return_id }}</td>
                        <td>{{ $item->orderItem->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>£{{ $item->total }}</td>
                        <td>{{ $item->reason }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td style="display: flex; flex-direction: column; gap: 5px;">
                            <form method="POST"
                                  action="{{ route('adminrefund.confirm', ['returnItem' => $item->return_id]) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="confirm" value="confirm">
                                <button type="submit"
                                        class="filter-btn small-btn" {{ $item->status != 'returned' ? 'disabled' : '' }}>
                                    Confirm
                                </button>
                            </form>
                            <form method="POST"
                                  action="{{ route('adminrefund.reject', ['returnItem' => $item->return_id]) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="reject" value="reject">
                                <button type="submit"
                                        class="delete-btn small-btn" {{ $item->status != 'returned' ? 'disabled' : '' }}>
                                    Reject
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <style>
        .container2 {
            width: 85%;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.08);
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

        .small-btn {
            font-size: 13px;
            padding: 6px 12px;
        }

        .clickable:hover {
            background-color: #f8f8f8;
            cursor: pointer;
        }
    </style>

    <script>
        document.querySelectorAll('.clickable').forEach(row => {
            row.addEventListener('click', function () {
                window.location.href = this.dataset.href;
            });
        });
    </script>
</x-newheader>
