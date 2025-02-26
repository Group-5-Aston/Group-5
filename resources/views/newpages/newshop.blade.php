<x-newheader>
    <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">
      <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="box">
                    <a href="{{ route('product') }}">
                    <a href="product/product1">
                            <div class="img-box">

                                <img src = "images/p1.jpg" alt="ring" style="width: 100%; height: auto;"></src>
                            </div>
                            <div class="detail-box">
                                <h6>
                                    Bundle - Dogfood
                                </h6>
                                <h6>
                                    Price
                                    <span>
                    £45
                  </span>
                                </h6>
                            </div>
                            <div class="new">
                <span>
                  New
                </span>
                            </div>
                        </a>
                        </a>
                    </div>
                </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
          <a href="{{ route('product') }}">
            <a href="product/product2">
              <div class="img-box">
                <img src="images/p2.jpg" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                  Bundle - Catfood
                </h6>
                <h6>
                  Price
                  <span>
                    £55
                  </span>
                </h6>
              </div>
              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
          <a href="{{ route('product') }}">
          <a href="product/product3">
              <div class="img-box">
                <img src="images/p3.jpg" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                  Dog Biscuits
                </h6>
                <h6>
                  Price
                  <span>
                    £10
                  </span>
                </h6>
              </div>
              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
          <a href="{{ route('product') }}">
          <a href="product/product4">
              <div class="img-box">
                <img src="images/p4.jpg" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                  Cat Biscuits
                </h6>
                <h6>
                  Price
                  <span>
                    £15
                  </span>
                </h6>
              </div>
              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
          <a href="{{ route('product') }}">
          <a href="product/product5">
              <div class="img-box">
                <img src="images/p5.jpg" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                  Protein Dog Food
                </h6>
                <h6>
                  Price
                  <span>
                    £35
                  </span>
                </h6>
              </div>
              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
          <a href="{{ route('product') }}">
          <a href="product/product6">
              <div class="img-box">
                <img src="images/p6.jpg" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                  Wet Mixed Dog Food
                </h6>
                <h6>
                  Price
                  <span>
                    £10
                  </span>
                </h6>
              </div>
              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
          <a href="{{ route('product') }}">
          <a href="product/product7">
              <div class="img-box">
                <img src="images/p7.jpg" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                  Wet Mixed Cat Food
                </h6>
                <h6>
                  Price
                  <span>
                    £20
                  </span>
                </h6>
              </div>
              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
          <a href="{{ route('product') }}">
          <a href="product/product8">
              <div class="img-box">
                <img src="images/p8.jpg" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                  Cat Protein Food
                </h6>
                <h6>
                  Price
                  <span>
                    £50
                  </span>
                </h6>
              </div>
              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div>
      </div>







      <div class="btn-box">
        <a href="{{ route('fullshop') }}">
          View All Products
        </a>
      </div>
    </div>
  </section>
    @include('components.newfooter')
</x-newheader>
