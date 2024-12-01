<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout</title>
</head>
<body>
    <h1>Your Cart</h1>
    
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>${{ number_format($item['price'], 2) }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <p><strong>Total Price: </strong>${{ number_format($cart->sum(function ($item) { return $item['price'] * $item['quantity']; }), 2) }}</p>
    
    <!-- Payment Button -->
    <a href="{{ route('payment') }}" class="btn btn-primary">Proceed to Payment</a>
</body>
</html>
