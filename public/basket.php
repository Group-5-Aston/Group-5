<?php
session_start();

// Retrieve the cart from the session
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Calculate the total price
$totalPrice = 0;
if (!empty($cart)) {
    foreach ($cart as $item) {
        $totalPrice += $item['price'] * $item['quantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="images/logo.jpg" type="image/x-icon">
    <title>Pup&Purr | Basket</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/responsive.css" rel="stylesheet" />
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
      <header class="header_section" style="background-color: #fefbe6;">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="index.html">
            <span style="color: #426b1f;">
              Pup&Purr
            </span>
            <img src="images/logo.jpg" alt="Logo" style="height: 60px; margin-right: 10px;">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""></span>
          </button>
  
          <div class="collapse navbar-collapse innerpage_navbar" id="navbarSupportedContent" style="background-color: #CFDCC0;">
            <ul class="navbar-nav">
              <li class="nav-item ">
                <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="shop.html">
                  Shop
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="why.html">
                  About Us
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Get in Touch</a>
              </li>
            </ul>
            <div class="user_option">
              <a href="login.html">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>
                  Login
                </span>
              </a>
              <a href="basket.php" class="active">
                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
              </a>
              <form class="form-inline ">
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

    <!-- basket section -->
    <section class="basket_section layout_padding" style="padding-top: 48px">
        <div class="container">
            <div class="heading_container">
                <h2>Your Basket</h2>
            </div>
            <div class="row">
                <?php if (empty($cart)): ?>
                    <p class="alert alert-warning">Your cart is currently empty.</p>
                <?php else: ?>
                    <?php foreach ($cart as $productId => $item): ?>
                        <div class="col-md-12 cart-item">
                            <div class="cart-item-details">
                                <span><?= htmlspecialchars($item['name']); ?></span>
                                <span>$<?= number_format($item['price'], 2); ?></span>
                                <input type="number" class="item-quantity" value="<?= $item['quantity']; ?>" min="1">
                                <button class="remove-item btn btn-danger">Remove</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="total-price">
                        <p><strong>Total Price:</strong> $<?= number_format($totalPrice, 2); ?></p>
                    </div>
                    <?php if (!empty($cart)): ?>
                        <a href="checkout.php" class="btn btn-success btn-block">Proceed to Checkout</a>
                    <?php else: ?>
                        <button class="btn btn-success btn-block" disabled>Proceed to Checkout</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- footer section -->
    <footer class="footer_section">
        <div class="container">
            <p>&copy; <span id="displayYear"></span> All Rights Reserved By Pup&Purr</p>
        </div>
    </footer>
    <!-- end footer section -->
</body>

</html>
