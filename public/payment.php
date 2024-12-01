<?php
// Start the session to track payment status (if needed)
session_start();

// Dummy payment processing logic
$paymentStatus = "pending";  // Default payment status is pending

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simulate payment success or failure based on a random outcome
    $paymentStatus = (rand(0, 1) === 1) ? "success" : "failure";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pup&Purr | Payment</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="css/style.css" rel="stylesheet">
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
              <li class="nav-item active">
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
              <a href="basket.php">
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

    <!-- payment section -->
    <section class="payment_section layout_padding" style="padding-top: 48px">
        <div class="container">
            <div class="heading_container">
                <h2>Payment Information</h2>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <form action="payment.php" method="POST">
                        <div class="form-group">
                            <label for="card-number">Card Number</label>
                            <input type="text" id="card-number" name="card_number" class="form-control" placeholder="Enter Card Number" required>
                        </div>
                        <div class="form-group">
                            <label for="expiry-date">Expiry Date</label>
                            <input type="text" id="expiry-date" name="expiry_date" class="form-control" placeholder="MM/YY" required>
                        </div>
                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" id="cvv" name="cvv" class="form-control" placeholder="CVV" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Pay Now</button>
                    </form>
                </div>
            </div>

            <!-- Payment status message -->
            <?php if ($paymentStatus === "success"): ?>
                <div class="alert alert-success mt-4">
                    <strong>Payment Successful!</strong> Your order has been processed. Thank you for shopping with us.
                </div>
            <?php elseif ($paymentStatus === "failure"): ?>
                <div class="alert alert-danger mt-4">
                    <strong>Payment Failed!</strong> Please try again or check your payment details.
                </div>
            <?php else: ?>
                <div class="alert alert-info mt-4">
                    <strong>Processing payment...</strong> Please wait while we process your payment.
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- footer section -->
    <footer class=" footer_section">
      <div class="container">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="https://html.design/">Pup&Purr</a>
        </p>
      </div>
    </footer>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>
