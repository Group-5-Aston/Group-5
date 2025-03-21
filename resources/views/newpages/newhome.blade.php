<x-newheader>
    <section class="slider_section">
        <div class="slider_container" style="background-color: #fefbe6;">

            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="detail-box">
                                        <h1 style="-webkit-text-fill-color: #355716;">
                                            Welcome To Our <br>
                                            Pet Shop
                                        </h1>
                                        <p></p>
                                        <p></p>
                                        <p style="-webkit-text-fill-color: #294313;">

                                            Your pets deserve the very best, and we’re here to deliver! Explore our wide
                                            range of stylish pet clothing, delicious treats, and essential supplies for
                                            cats and dogs. Whether you’re pampering your furry companion or stocking up
                                            on the basics, we’ve got everything you need to keep them happy, healthy,
                                            and looking their best. </p>
                                        <a href= {{route('contact')}}>
                                            Contact Us
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="img-box" style="padding-top: 10px; position: relative;">
                                        <img src="images/logo.jpg" alt="Pet Shop" class="img-fluid"
                                             style="width: 100%; height: auto; position: relative; left: -20px; top: 10px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        </div>
    </section>

    <!-- end slider section -->
    </div>
    <!-- end hero area -->

    <!-- shop section -->


    <!-- Newest Products Section -->
    <x-newshopshower :products="\App\Models\Product::inRandomOrder()->limit(4)->get()">
        <h2>Check Out Our Newest Products</h2>
    </x-newshopshower>


    <!-- end off banner section -->

    <!-- info section -->
    <section class="client_section layout_padding" style="padding-top: 60px;">

        <div class="heading_container heading_center">
            <h2>
                Customer reviews
            </h2>
        </div>

        <div class="container px-0" style="padding-top: 20px;">
            <div id="customCarousel2" class="carousel  carousel-fade" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="box" style="background-color: #ffffff;">
                            <div class="client_info">
                                <div class="client_name">
                                    <h5>
                                        Harry M
                                    </h5>
                                    <h6>
                                        "Perfect for my picky pup!"
                                    </h6>
                                </div>
                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                            </div>
                            <p>
                                "I’ve tried so many products for my dog, and this is the first shop where everything
                                feels like it’s made with care. The toys are durable, the clothes fit perfectly, and my
                                dog actually enjoys the treats! It’s now my go-to store for all his needs. 🐕" </p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="box" style="background-color: #ffffff;">
                            <div class="client_info">
                                <div class="client_name">
                                    <h5>
                                        Brian H.
                                    </h5>
                                    <h6>
                                        "Great quality and adorable designs!"
                                    </h6>
                                </div>
                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                            </div>
                            <p>
                                "I ordered a raincoat for my cat (yes, she loves being outside in the rain!), and it’s
                                both functional and super cute. The material is high quality, and the fit is just right.
                                This shop really understands pets and their owners! 🐱"
                            </p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="box" style="background-color: #ffffff;">
                            <div class="client_info">
                                <div class="client_name">
                                    <h5>
                                        Sarah L.
                                    </h5>
                                    <h6>
                                        "So much variety!"
                                    </h6>
                                </div>
                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                            </div>
                            <p>
                                "I’m amazed at how many options this shop has! I found unique treats, a stylish leash,
                                and even matching sweaters for me and my dog. Everything arrived quickly, and the
                                quality exceeded my expectations. Highly recommend for pet parents who want the best.
                                🐾" </p>
                        </div>
                    </div>
                </div>
                <div class="carousel_btn-box">
                    <a class="carousel-control-prev" href="#customCarousel2" role="button" data-slide="prev">
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#customCarousel2" role="button" data-slide="next">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <style>
        .carousel-item .box:hover {
            transform: none !important; /* stops theh hover effect */
            transition: none !important;
        }
    </style>
    <!-- end client review section -->

    <!-- client review section -->


    @include ('components.newfooter')
</x-newheader>


