<x-newheader>
<section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Check out our Dog Products
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
          <a href="product/product6">
              <div class="img-box">
                <img src="images/p6.jpg" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                  Dog Biscuits
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
          <a href="product/product9">
              <div class="img-box">
                <img src="images/p9.jpg" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                  Dog Toys
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
          <a href="product/product11">
              <div class="img-box">
                <img src="images/p11.jpg" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                 Dog Shampoo
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
          <a href="product/product13">
              <div class="img-box">
                <img src="images/p13.jpg" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                 Dog Bed
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
          <a href="product/product16">
              <div class="img-box">
                <img src="images/p16.jpg" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                 Dog Dental Products
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
        <a href="{{route ('shop')}}">
           Return to Main Products Page
        </a>
      </div>


  </section>

    @include('components.newfooter')
</x-newheader>
