<!DOCTYPE html>
<html lang="en">

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

    <title>Pup & Purr - Product</title>

    <!-- Slider Stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <!-- Responsive style -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />

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
          font-weight: bold;
      }

      .basket-button span {
          font-size: 18px;
          margin-left: 10px;
      }

        .product-options .form-group {
            margin-bottom: 1rem;
        }

        
    </style>
</head>

<body>
    <div class="hero_area">
        <!-- Header Section -->
        <header>
            <nav class="navbar">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Pup & Purr Logo" style="height: 75px;">
                    <span style="color: #426b1f; font-size: 28px; font-weight: bold;">Pup & Purr</span>
                </a>

                <div class="navbar-links">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('shop') }}">Shop</a>
                    <a href="{{ route('why') }}">About Us</a>
                    <a href="{{ route('contact') }}">Contact Us</a>
                </div>

                <div class="navbar-icons">
                    <a href="{{ route('loginpage') }}"><i class="fa fa-user"></i></a>
                    <a href="{{ route('basket.index') }}"><i class="fa fa-shopping-basket"></i></a>
                </div>
            </nav>
        </header>
        <!-- End Header Section -->
    </div>

    <!-- Product Section -->
    <div class="container my-5">
    <div class="row">
    <!-- Product Image -->
        <div class="col-md-6">
            <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="product-image w-100">
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
        <div class="product-details">
            <h1>{{ $product['name'] }}</h1>
            <h3>£{{ $product['price'] }}</h3>
            <p>{{ $product['label'] }}</p>

            <!-- Product Options -->
            <form action="{{ route('basket.add') }}" method="POST">
                @csrf
                <div class="product-options">
                    <!-- Quantity -->
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" min="1" value="1"  class="form-control" style="width: 120px;">
                    </div>

                    <!-- Check if it's food -->
        @if($product['is_food'])
            <!-- Package Size Selection -->
            <div class="form-group">
                <label for="psize">Package Size:</label>
                <select id="psize" name="psize" class="form-control">
                    @foreach($product['package_size_options'] as $psize)
                        <option value="{{ $psize }}">{{ ucfirst($psize) }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Flavor Selection -->
            <div class="form-group">
                <label for="flavor">Flavor:</label>
                <select id="flavor" name="flavor" class="form-control">
                    @foreach($product['flavor_options'] as $flavor)
                        <option value="{{ $flavor }}">{{ ucfirst($flavor) }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <!-- Check if it's a toy or bed -->
        @if($product['is_toy_or_bed'])
            <!-- Size Selection (for beds or toys that have a size) -->
            <div class="form-group">
                <label for="size">Size:</label>
                <select id="size" name="size" class="form-control">
                    @foreach($product['size_options'] as $size)
                        <option value="{{ $size }}">{{ ucfirst($size) }}</option>
                    @endforeach
                </select>
            </div>
        @endif

                    <!-- Hidden Inputs for the product details -->
                    <input type="hidden" name="name" value="{{ $product['name'] }}">
                    <input type="hidden" name="price" value="{{ $product['price'] }}">
                    <input type="hidden" name="image" value="{{ asset($product['image']) }}">

                    <!-- Add to Basket Button -->
                    <button type="submit" class="btn btn-dark btn-block mt-4">Add to Basket</button>
                    </div>
            </form>
        </div>
    </div>

    <!-- Tabs Section -->
    <div class="tabs-section">
      <ul class="nav nav-tabs" id="productTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
        </li>
      </ul>
    <div class="tab-content" id="productTabContent">
        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
        <p class="mt-3">{{ $product['description'] }}</p>
        </div>
        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
        <p class="mt-3">No reviews yet. Be the first to review this product!</p>
        </div>
      </div>
    </div>
    </div>
    <!-- Footer Section -->
    <footer class="footer_section">
        <div class="container">
            <p>
                &copy; <span id="displayYear"></span> All Rights Reserved By
                <a href="#">Pup & Purr</a>
            </p>
        </div>
    </footer>

</body>

</html>
