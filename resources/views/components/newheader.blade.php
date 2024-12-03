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
</head>

<body>
<div class="hero_area">
    <!-- header section strats -->
    <header class="header_section" style="background-color: #fefbe6;">
        <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="{{ route('home') }}">
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
                        <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropbtn" href="{{ route('shop') }}">Shop</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('catshop') }}" class="dropdown-item">cats</a></li>
                            <li><a href="{{ route ('dogshop') }}" class="dropdown-item">dogs</a></li>
                        </ul>
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
</div>

{{ $slot }}
</body>
</html>

