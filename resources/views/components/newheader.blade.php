<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!-- Site Metas -->
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        Pup&Purr
    </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}"/>

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- responsive style -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">


    <style>
        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding-top: 100px;
        }

        /* the top header styles and designs  */
        header {
            background: #fefbe6;
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
            height: 30px;
        }

        .navbar-brand img {
            height: 50px;
        }

        .navbar-links {
            display: flex;
            gap: 20px;
            align-items: center;
            position: relative;
        }

        .navbar-links a {
            text-decoration: none;
            color: #426b1f;
            font-size: 16px;
            text-transform: uppercase;
            padding: 5px;
            display: inline-block;
        }

        .nav-item.dropdown {
            position: relative;

        }

        .navbar-links li {
            list-style: none;
        }

        .navbar-links a:hover {
            font-weight: bold;
        }

        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            padding: 10px 0;
        }

        .nav-item.dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
        }

        .navbar-icons {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .navbar-icons a {
            color: #426b1f;
            font-size: 18px;
        }


        .search-filter-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Search Bar Input */
        .search-bar {
            padding: 9px 16px;
            border: 1px solid #3b5e3b;
            border-radius: 30px;
            font-size: 15px;
            width: 220px;
            transition: border-color 0.3s, box-shadow 0.3s;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .search-bar:focus {
            border-color: #4B7C47;
            box-shadow: 0 0 8px rgba(75, 124, 71, 0.5);
        }

        /* Search Button */
        .search-button {
            background-color: #4B7C47;
            color: white;
            border: none;
            padding: 9px 20px;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;

        }

        .search-button:hover {
            background-color: #3b511f;
        }

        .search-button:focus {
            outline: none;
        }

        /* Filter Button */
        .filter-btn {
            background-color: #4B7C47;
            color: white;
            border: none;
            padding: 9px 20px;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;

        }

        .filter-btn:hover {
            background-color: #3b511f;
            color: white;
        }

        .filter-btn:focus {
            outline: none;
        }

        .filter-btn:disabled {
            background-color: lightgrey;
        }

        /* Icon size for filter button */
        .filter-btn i.fa-filter {
            font-size: 16px;
        }


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
            width: 90%;
            margin: auto;
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
            width: 90%;
            margin: auto;
            justify-content: space-between;
            border-bottom: 1px solid #ddd;
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

        .checkout-container {
            padding-top: 0px;
        }

        .checkout-title {
            width: 90%;
            margin: 0 auto;
            padding-bottom: 10px;
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
    <!-- header section starts -->
    <header>
        <nav class="navbar">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.jpg') }}" alt="Pup & Purr Logo" style="height: 75px;">
                <span style="color: #426b1f; font-size: 28px; font-weight: bold;">Pup & Purr</span>
            </a>

            <div class="navbar-links">
                <li class="nav-item dropdown">
                    <a class="nav-link dropbtn" href="{{ route('shop', ['animal' => 'cat', 'type' => 'all', 'query' => 'cat'])  }}">Cats</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('shop', ['animal' => 'cat', 'type' => 'all', 'query' => 'cat'])  }}" class="dropdown-item">All Products</a></li>
                        <li><a href="{{ route('shop', ['animal' => 'cat', 'type' => 'clothes', 'query' => 'catClothes']) }}" class="dropdown-item">Clothes & Accessories</a></li>
                        <li><a href="{{ route('shop', ['animal' => 'cat', 'type' => 'toys', 'query' => 'catToys']) }}" class="dropdown-item">Toys</a></li>
                        <li><a href="{{ route('shop', ['animal' => 'cat', 'type' => 'food', 'query' => 'catFood']) }}" class="dropdown-item">Food</a></li>
                        <li><a href="{{ route('shop', ['animal' => 'cat', 'type' => 'hygiene', 'query' => 'catHygiene']) }}" class="dropdown-item">Hygiene</a></li>
                        <li><a href="{{ route('shop', ['animal' => 'cat', 'type' => 'bed', 'query' => 'catBed']) }}" class="dropdown-item">Bedding</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropbtn" href="{{ route('shop', ['animal' => 'dog', 'type' => 'all', 'query' => 'dog']) }}">Dogs</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('shop', ['animal' => 'dog', 'type' => 'all', 'query' => 'dog']) }}" class="dropdown-item">All Products</a></li>
                        <li><a href="{{ route('shop', ['animal' => 'dog', 'type' => 'clothes', 'query' => 'dogClothes']) }}" class="dropdown-item">Clothes & Accessories</a></li>
                        <li><a href="{{ route('shop', ['animal' => 'dog', 'type' => 'toys', 'query' => 'dogToys']) }}" class="dropdown-item">Toys</a></li>
                        <li><a href="{{ route('shop', ['animal' => 'dog', 'type' => 'food', 'query' => 'dogFood']) }}" class="dropdown-item">Food</a></li>
                        <li><a href="{{ route('shop', ['animal' => 'dog', 'type' => 'hygiene', 'query' => 'dogHygiene']) }}" class="dropdown-item">Hygiene</a></li>
                        <li><a href="{{ route('shop', ['animal' => 'dog', 'type' => 'bed', 'query' => 'dogBed']) }}" class="dropdown-item">Bedding</a></li>
                    </ul>
                </li>

                <a href="{{route('why')}}">About Us</a>
                <a href="{{ route('contact') }}">Contact Us</a>
            </div>
            <div class="search-filter-container">
                <!-- Search Form -->
                <form action="{{ route('product.search') }}" method="GET">
                    <input
                        type="text"
                        class="search-bar"
                        name="q"
                        placeholder="Search products..."
                        value="{{ request('q') }}"
                    >
                    <button type="submit" class="search-button">
                        <i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i>
                    </button>
                </form>

                <!-- Filter Button (Icon Only) -->
                <a href="{{ route('filter.page') }}" class="filter-btn" title="Filter">
                    <i class="fa fa-filter"></i>
                </a>
            </div>

            <!-- Profile dropdown -->
            <div class="navbar-icons">
                <div class="nav-item dropdown">
                    @if(Auth::check())
                        <!-- Dropdown Toggle -->
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="userDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <i class="fa fa-user"></i>
                            <!-- If the name has more than 17 characters, put ... at the end -->
                            {{ strlen(Auth::user()->name) > 17 ? substr(Auth::user()->name, 0, 17) . '...' : Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown"  style="right: -40px; left: auto">
                            <li><a href="{{ route('profile.edit') }}" class="dropdown-item">Edit Profile</a></li>
                            <li><a href="{{ route('order.index') }}" class="dropdown-item">Orders</a></li>
                            <li><a href="{{ route('return.index') }}" class="dropdown-item">Returns</a></li>

                            @if(Auth::user()->usertype == 'admin')
                                <li><a href="{{ route('admin.dashboard') }}" class="dropdown-item">Admin Dashboard</a></li>
                            @endif

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    @else
                        <a href="{{ route('loginpage') }}" class="nav-link">
                            <i class="fa fa-user"></i>
                            Login
                        </a>
                    @endif
                </div>

                <!-- Basket Icon -->
                <a href="{{ route('basket.index') }}">
                    <i class="fa fa-shopping-basket"></i>
                </a>
            </div>
        </nav>
    </header>
    <!-- end header section -->

</div>

{{ $slot }}
</body>
</html>

