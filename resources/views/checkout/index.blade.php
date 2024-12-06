<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pup & Purr - Checkout</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}" type="image/x-icon">

    <!-- Main Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

    <style>
        body {
            font-family: "Poppins", sans-serif;
        }

        /* the top header styles and designs  */
        header {
            background: #fefbe6;
            padding: 10px 20px;
            border-bottom: 2px solid #7b8e4e;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand img {
            height: 50px;
        }

        .navbar-links {
            display: flex;
            gap: 20px;
        }

        .navbar-links a {
            text-decoration: none;
            color: #426b1f;
            font-size: 16px;
            text-transform: uppercase;
        }

        .navbar-links a:hover {
            font-weight: bold;
        }

        .navbar-icons {
            display: flex;
            gap: 15px;
        }

        .navbar-icons a {
            color: #426b1f;
            font-size: 18px;
        }

        /*The  Basket Page */
        .basket-container {
            margin: 0 auto;
            max-width: 1200px;
            padding: 50px 20px;
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .basket-items,
        .order-summary {
            padding: 20px;
            background: #fefefe;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(123, 142, 78, 0.2);
        }

        .basket-items {
            flex: 2;
        }

        .order-summary {
            flex: 1;
        }

        .basket-title {
            font-size: 28px;
            color: #426b1f;
            margin-bottom: 20px;
        }

        .item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }

        .item img {
            width: 80px;
            height: auto;
            border-radius: 5px;
        }

        .item-name {
            flex: 1;
            margin: 0 20px;
            font-size: 16px;
            color: #333;
        }

        .item-price {
            font-weight: bold;
            color: #7b8e4e;
        }

        .item-quantity {
            flex: 1;
            margin: 0 20px;
            font-size: 16px;
            color: #333;
        }

        .item-flavor {
            flex: 0.5;
            margin: 0 20px;
            font-size: 16px;
            color: #333;
        }

        .item-psize {
            flex: 1;
            margin: 0 20px;
            font-size: 16px;
            color: #333
        }

        .item-size {
            flex: 1.6;
            margin: 0 20px;
            font-size: 16px;
            color: #333
            align-items: center;

        }

        .summary-title {
            font-size: 24px;
            color: #426b1f;
            margin-bottom: 15px;
        }

        .summary-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .summary-total {
            font-size: 18px;
            font-weight: bold;
            color: #426b1f;
        }

        .basket-button {
            margin-top: 20px;
            padding: 12px 20px;
            font-size: 16px;
            background: #426b1f;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .basket-button:hover {
            background: #355716;
        }

        .basket-button span {
            font-size: 18px;
            margin-left: 10px;
        }

        .checkout-button {
            margin-top: 20px;
            padding: 12px 20px;
            font-size: 16px;
            background: #426b1f;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .checkout-button:hover {
            background: #355716;
        }
    </style>
</head>

<body>
    <!-- The Header Section -->
    <header>
        <nav class="navbar">
            <a class="navbar-brand" href="index.html">
                <img src="images/logo.jpg" alt="Pup & Purr Logo" style="height: 75px;">
                <span style="color: #426b1f; font-size: 28px; font-weight: bold;">Pup & Purr</span>
            </a>

            <div class="navbar-links">
                <a href="index.html">Home</a>
                <a href="shop">Shop</a>
                <a href="why.html">About Us</a>
                <a href="contact.html">Contact Us</a>
            </div>

            <div class="navbar-icons">
                <a href="login.html"><i class="fa fa-user"></i></a>
                <a href="basket"><i class="fa fa-shopping-basket"></i></a>
            </div>
        </nav>
    </header>


    <!-- Checkout Section -->
    <section class="checkout-container">
        <!-- Checkout Items -->
        <div class="checkout-details">
            <h2 class="checkout-title">Your Items</h2>
    @foreach($basket as $item)
    <div class="item">
        <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}">
        <p class="item-name">{{ $item['name'] }}</p>
        @if(!empty($item['psize']))
            <p class="item-psize">Size: {{ ucfirst($item['psize']) }}</p>
        @endif
        @if(!empty($item['flavor']))
            <p class="item-flavor">Flavor: {{ ucfirst($item['flavor']) }}</p>
        @endif
        @if(!empty($item['size']))
            <p class="item-size">Size: {{ ucfirst($item['size']) }}</p>
        @endif
        <p class="item-quantity">Quantity: {{ $item['quantity'] }}</p>
        <p class="item-price">£{{ number_format($item['price'], 2) }}</p>
        
    </div>
@endforeach


        </div>

        <!-- Order Summary -->
        <div class="order-summary">
            <h2 class="summary-title">Order Summary</h2>
            <div class="summary-details">
                <span>Subtotal:</span>
                <span>£{{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="summary-details">
                <span>Shipping:</span>
                <span>£{{ number_format($shipping, 2) }}</span>
            </div>
            <div class="summary-details">
                <span>VAT:</span>
                <span>£{{ number_format($vat, 2) }}</span>
            </div>
            <div class="summary-details summary-total">
                <span>Total:</span>
                <span>£{{ number_format($total, 2) }}</span>
            </div>
            <a href="{{ route('payment.index') }}" class="checkout-button">Proceed to Payment</a>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer_section" style="background-color: #fefbe6; text-align: center; padding: 20px 0; display: flex; justify-content: center; align-items: center;">
    <p style="margin: 0; font-size: 14px; color: #355716;">
        &copy; <span id="displayYear"></span> All Rights Reserved By 
        <a href="index.html" style="color: #294313; text-decoration: none;">Pup & Purr</a>
    </p>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
