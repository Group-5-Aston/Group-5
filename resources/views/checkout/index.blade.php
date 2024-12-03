<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}" type="image/x-icon">
    <title>Pup&Purr | Checkout</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="hero_area">
        <!-- header section starts -->
        <header class="header_section" style="background-color: #fefbe6;">
            <nav class="navbar navbar-expand-lg custom_nav-container">
                <a class="navbar-brand" href="{{ url('index.html') }}">
                    <span style="color: #426b1f;">
                        Pup&Purr
                    </span>
                    <img src="{{ asset('images/logo.jpg') }}" alt="Logo" style="height: 60px; margin-right: 10px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""></span>
                </button>

                <div class="collapse navbar-collapse innerpage_navbar" id="navbarSupportedContent" style="background-color: #CFDCC0;">
                    <ul class="navbar-nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ url('index.html') }}">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('shop.html') }}">
                                Shop
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('why.html') }}">
                                About Us
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('contact.html') }}">Get in Touch</a>
                        </li>
                    </ul>
                    <div class="user_option">
                        <a href="{{ url('login.html') }}">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>
                                Login
                            </span>
                        </a>
                        <a href="{{ url('basket.php') }}">
                            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                        </a>
                        <form class="form-inline">
                            <button class="btn nav_search-btn" type="submit">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
        </header>
        <!-- end header section -->
    </div>
    <!-- end hero area -->

    <!-- checkout section -->
    <section class="checkout_section layout_padding" style="padding-top: 48px">
        <div class="container">
            <div class="heading_container">
                <h2>Checkout</h2>
            </div>

            <div class="row">
                <!-- Cart items will be populated dynamically -->
                @foreach ($cart as $item)
                <div class="col-md-12 cart-item" data-item-id="{{ $item['id'] }}">
                    <div class="cart-item-details">
                        <span>{{ $item['name'] }}</span>
                        <span>${{ number_format($item['price'], 2) }}</span>
                        <span>Quantity: {{ $item['quantity'] }}</span>
                        <span>Total: ${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="total-price">
                        <p><strong>Total Price:</strong> ${{ number_format($totalPrice, 2) }}</p>
                    </div>
                    <a href="{{ route('payment.index') }}" class="btn btn-success btn-block">Proceed to Payment</a>
                </div>
            </div>
        </div>
    </section>
    <!-- end checkout section -->

    <!-- footer section -->
    <footer class="footer_section">
        <div class="container">
            <p>
                &copy; <span id="displayYear"></span> All Rights Reserved By
                <a href="https://html.design/">Pup&Purr</a>
            </p>
        </div>
    </footer>
    <!-- footer section -->
    </section>

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <script>
        // Fetch the current cart data on page load
        $(document).ready(function () {
            loadCart();

            // Load cart items for checkout page
            function loadCart() {
                $.ajax({
                    url: '{{ route('cart.get') }}',
                    method: 'GET',
                    success: function(response) {
                        const cartData = response;
                        const cartItemsContainer = $('#cart-items');
                        cartItemsContainer.empty();  // Clear existing items

                        let total = 0;
                        cartData.items.forEach(item => {
                            cartItemsContainer.append(`
                                <div class="col-md-12 cart-item" data-item-id="${item.id}">
                                    <div class="cart-item-details">
                                        <span>${item.name}</span>
                                        <span>$${item.price}</span>
                                        <span>Quantity: ${item.quantity}</span>
                                        <span>Total: $${(item.price * item.quantity).toFixed(2)}</span>
                                    </div>
                                </div>
                            `);
                            total += item.price * item.quantity;
                        });

                        // Update total price
                        $('#cart-total').text(total.toFixed(2));
                    }
                });
            }
        });
    </script>
</body>

</html>