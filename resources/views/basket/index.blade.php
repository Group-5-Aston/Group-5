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
                <a href="shop.html">Shop</a>
                <a href="why.html">About Us</a>
                <a href="contact.html">Contact Us</a>
            </div>

            <div class="navbar-icons">
                <a href="login.html"><i class="fa fa-user"></i></a>
                <a href="basket.html"><i class="fa fa-shopping-basket"></i></a>
            </div>
        </nav>
    </header>

    <!-- Basket Section -->
    <main class="basket-container">
        <section class="basket-items">
            <h1 class="basket-title">Basket</h1>

            @foreach($basket as $item)
            <div class="item">
                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                <p class="item-name">{{ $item['name'] }}</p>
                <p class="item-price">£{{ number_format($item['price'], 2) }}</p>
            </div>
            @endforeach
        </section>

        <!-- Order Summary -->
<aside class="order-summary">
    <h2 class="summary-title">Order Summary</h2>
    
    <div class="summary-details">
        <p>Subtotal</p>
        <p>£{{ number_format($subtotal, 2) }}</p>
    </div>
    <div class="summary-details">
        <p>Shipping</p>
        <p>£{{ number_format($shipping, 2) }}</p>
    </div>
    <div class="summary-details">
        <p>V.A.T</p>
        <p>£{{ number_format($vat, 2) }}</p>
    </div>
    <div class="summary-details summary-total">
        <p>Total</p>
        <p>£{{ number_format($total, 2) }}</p>
    </div>

    <a href="{{ route('checkout.index') }}" class="basket-button">Continue to Checkout →</a>
</aside>



    </main>
</body>

</html>