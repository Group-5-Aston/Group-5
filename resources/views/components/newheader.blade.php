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
            margin: 0;
            padding-top: 150px; /* Adjust this so content doesn’t get hidden behind the fixed header */
        }

        /* the top header styles and designs  */
        header {
            background: #fefbe6;
            padding: 10px 20px;
            border-bottom: 2px solid #7b8e4e;
            position: fixed; /* Fixes the header in place */
            top: 0; /* Aligns it at the top */
            left: 0;
            width: 100%; /* Makes sure it spans the whole width */
            z-index: 1000; /* Ensures it stays above other elements */
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

        .search-container {
      display: flex;
      align-items: center;
      gap: 10px;
  }

  /* Search bar and filter button alignment */
  .search-container {
      display: flex;
      align-items: center;
      gap: 10px;
  }

  .search-bar {
      padding: 8px 12px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
      width: 250px;
  }

  .search-button {
      background-color: #4B7C47; /* Green button */
      color: white;
      border: none;
      padding: 8px 15px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
  }

  .search-button:hover {
      background-color: #3a6240;
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

        .product-options .form-group {
            margin-bottom: 1rem;
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

        .remove-button {
            background: #ff4d4d;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        .remove-button:hover {
            background: #e60000;
        }
    </style>
</head>

<body>
<div class="hero_area">
    <!-- header section strats -->
    <header>
        <nav class="navbar">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.jpg') }}" alt="Pup & Purr Logo" style="height: 75px;">
                <span style="color: #426b1f; font-size: 28px; font-weight: bold;">Pup & Purr</span>
            </a>

            <div class="navbar-links">
                <a href="{{ route('home') }}">Home</a>
                <li class="nav-item dropdown">
                    <a class="nav-link dropbtn" href="{{ route('catshop') }}">Cats</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('catshop') }}" class="dropdown-item">All Products</a></li>
                        <li><a href="{{route('catclothes') }}" class="dropdown-item">Clothes & Accessories</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropbtn" href="{{ route('dogshop') }}">Dogs</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('dogshop') }}" class="dropdown-item">All Products</a></li>
                        <li><a href="{{ route('dogclothes') }}" class="dropdown-item">Clothes & Accessories</a></li>
                    </ul>
                </li>
                <a href="{{route('why')}}">About Us</a>
                <a href="{{ route('contact') }}">Contact Us</a>
            </div>
            <!-- Search and Filter Section --
<div class="search-container" style="display: flex; align-items: center; gap: 10px;">
    <form action="{{ route('product.search') }}" method="GET" style="display: flex; align-items: center; gap: 5px;">
        <input 
            type="text" 
            class="search-bar" 
            name="q" 
            placeholder="Search products..." 
            value="{{ request('q') }}">
        <button 
            type="submit" 
            class="search-button">
            Search
        </button>
    </form>
    <!--
    <button class="filter-btn" title="Filter">
        <i class="fas fa-filter"></i>
    </button>
</div>

            




        <!-- Profile dropdown -->
        <div class="navbar-icons">
            <div class="nav-item dropdown">
                @if(Auth::check())
                    <a class="nav-link dropdown-toggle" href="javascript:void(0);">
                        <i class="fa fa-user"></i>
                        {{Auth::User()->name}}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('profile.edit') }}" class="dropdown-item">Edit Profile</a></li>
                        <li><a href="" class="dropdown-item">Orders</a></li>
                        @if(Auth::User()->usertype == 'admin')
                            <li><a href="" class="dropdown-item">Admin Dashboard</a></li>
                        @endif
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                @else
                    <a href="{{ route('loginpage') }}">
                        <i class="fa fa-user"></i>
                        Login
                    </a>
                @endif
                </div>
                <a href="{{ route('basket.index') }}"><i class="fa fa-shopping-basket"></i></a>
        </div>
        </nav>
    </header>
    <!-- end header section -->

</div>

{{ $slot }}
</body>
</html>

