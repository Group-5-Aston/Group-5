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
              <div class="img-box">

              <img src = "images/p1.jpg" alt="ring" style="width: 100%; height: auto;"></src>
            </div>
              <div class="detail-box">
                <h6>
                bundle- dogfood
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
            <a href="p2.html">
              <div class="img-box">
                <img src="images/p2.jpg" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                  bundle- catfood
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
            <a href="p3.html">
              <div class="img-box">
                <img src="images/p3.jpg" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                  dog biscuits
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
            <a href="p4.html">
              <div class="img-box">
                <img src="images/p4.jpg" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                  cat biscuits
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
            <a href="p5.html">
              <div class="img-box">
                <img src="images/p5.jpg" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                  protein dog food
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
            <a href="p6.html">
              <div class="img-box">
                <img src="images/p6.jpg" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                  wet mixed dog food
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
            <a href="p7.html">
              <div class="img-box">
                <img src="images/p7.jpg" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                  wet mixed cat food
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
            <a href="p8.html">
              <div class="img-box">
                <img src="images/p8.jpg" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                  cat protein food
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
