<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        Pup&Purr
    </title>

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- responsive style -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">

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
            align-items: center;
            position: relative;
            margin: 0%;
            padding: 0%;
        }

        .navbar-links a {
            text-decoration: none;
            color: #426b1f;
            font-size: 16px;
            text-transform: uppercase;
            padding: 10px;
            display: inline-block;
        }

        .nav-item.dropdown{
            position: relative;
        }

        .navbar-links li{
            list-style: none;
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
    </style>
</head>

<body>
<div class="hero_area">
    <!-- header section strats -->
    <header>
        <nav class="navbar">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="images/logo.jpg" alt="Pup & Purr Logo" style="height: 75px;">
                <span style="color: #426b1f; font-size: 28px; font-weight: bold;">Pup & Purr</span>
            </a>

            <div class="navbar-links">
                <a href="{{ route('home') }}">Home</a>
                <li class="nav-item dropdown">
                    <a class="nav-link dropbtn" href="{{ route('shop') }}">Shop</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('catshop') }}" class="dropdown-item">Cats</a></li>
                        <li><a href="{{route('dogshop') }}" class="dropdown-item">Dogs</a></li>

                    </ul>
                <a href="{{route('why')}}">About Us</a>
                <a href="{{ route('contact') }}">Contact Us</a>
            </div>

            <div class="navbar-icons">
                <a href="{{ route('loginpage') }}"><i class="fa fa-user"></i></a>
                {{ Auth::check() ? Auth::user()->name : 'Log In'; }}
                <a href="basket.html"><i class="fa fa-shopping-basket"></i></a>
            </div>
        </nav>
    </header>
    <!-- end header section -->

</div>

{{ $slot }}
</body>
</html>

