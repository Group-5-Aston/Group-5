<style>
    .footer_section {
        width: 100%; /* Ensures full width without forcing viewport width */
        margin: 0;
        padding: 20px 0;
        background: #2D2D2D; /* Matches your design */
        text-align: center;
        position: relative;
        left: 0;
        right: 0;
    }

    .footer_section .container {
        width: 100%; /* Ensures no restriction */
        max-width: 100%;
        padding: 0;
        margin: 0 auto; /* Centers content properly */
    }

    .info_section {
        width: 100%; /* Full width without affecting viewport overflow */
        margin: 0;
        padding: 40px 0; /* Adjust spacing */
        background: #2D2D2D; /* Ensures uniform color */
        margin-top: 40px;
    }

    .info_container {
        width: 100%;
        max-width: 1200px; /* Prevents unnecessary stretching */
        margin: 0 auto;
        padding: 0;
    }

    /* Fix for cropping issue */
    body, html {
        width: 100%;
        margin: 0;
        padding: 0;
        overflow-x: hidden; /* Prevents horizontal scrolling issues */
    }

    /* Ensure the main content does not get cropped */
    .hero_area, .main-content {
        padding-top: 150px; /* Adds space at the top of the page */
    }
</style>


<section class="info_section  layout_padding2-top">
    <div class="social_container">
        <div class="social_box">
            <a href="https://facebook.com">
                <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
            <a href="https://x.com">
                <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
            <a href="https://instagram.com">
                <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
            <a href="https://youtube.com/">
                <i class="fa fa-youtube" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    <div class="info_container ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <h6>
                        ABOUT US
                    </h6>
                    <p>
                        We specialize in premium pet essentials, including stylish clothes, tasty treats, and everyday supplies for cats and dogs. Because they’re not just pets—they’re family. ❤️            </p>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="info_form ">
                        <h5>
                            Newsletter
                        </h5>
                        <form method="POST" action="{{route('subscribe')}}" >
                            @csrf
                            <input type="email" name="email" placeholder="Enter your email">
                            <button type="submit">
                                Subscribe
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <h6>
                        NEED HELP?
                    </h6>
                    <p>
                        We are here for you! Contact our friendly support team anytime for assistance with your orders or questions about our pet products.🐾            </p>
                </div>
                <div class="col-md-6 col-lg-3">
                    <h6>
                        CONTACT US
                    </h6>
                    <div class="info_link-box">
                        <a href="">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span> 64 Aston Road Birmingham UK </span>
                        </a>
                        <a href="">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span>+44 (0)121 204 3001</span>
                        </a>
                        <a href="">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <span> pup_purr@yahoo.com </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer section -->
    <footer class=" footer_section">
        <div class="container">
            <p>
                &copy; <span id="displayYear"></span> All Rights Reserved By
                <a href="https://html.design/">Pup&Purr</a>
            </p>
        </div>
    </footer>
    <!-- footer section -->

</section>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
</script>
<script src="js/custom.js"></script>

<!-- end info section -->
