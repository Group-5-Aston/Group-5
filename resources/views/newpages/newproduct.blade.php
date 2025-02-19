<x-newheader>
    <div class="container my-5">
        <div class="row">
           
            <div class="col-md-6">
                <img src="" class="product-image w-100" alt="Bundle Dog Food">
            </div>

          
            <div class="col-md-6">
                <div class="product-details">
                    <h1>Title</h1>
                    <h3 class="text-success">Price</h3>
                    <p>Description</p>
                    <div class="product-options">
                                            <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" min="1" value="1" class="form-control" style="width: 120px;">
                        </div>

                        <div class="form-group">
                            <label for="size">Package Size:</label>
                            <select id="size" name="size" class="form-control">
                                <option value="small">Small (2kg)</option>
                                <option value="medium">Medium (5kg)</option>
                                <option value="large">Large (10kg)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="flavor">Flavor:</label>
                            <select id="flavor" name="flavor" class="form-control">
                                <option value="chicken">chicken</option>
                                <option value="beef">beef</option>
                                <option value="lamb">lamb</option>
                                <option value="salmon">salmon</option>
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-dark btn-block mt-4">Add to Cart</button>
                </div>
            </div>
        </div>

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
                    <p class="mt-3">Description</p>
                </div>
                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                    <p class="mt-3">No reviews yet. Be the first to review this product!</p>
                </div>
            </div>
        </div>
    </div>
 
    <section class="info_section  layout_padding2-top">
        <div class="social_container">
            <div class="social_box">
                <a href="">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                </a>
                <a href="">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>
                <a href="">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
                <a href="">
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
                            <form action="#">
                                <input type="email" placeholder="Enter your email">
                                <button>
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
                                <span> contact@pup&purr.com</span>
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
    @include('components.newfooter')
</x-newheader>
