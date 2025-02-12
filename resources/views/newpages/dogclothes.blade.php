<x-newheader>
<style>
/* Applies background color to all containers and boxes */
.box {
    background-color: #fefbe6 !important;
}

/* Ensures text inside remains readable */
.box {
    color: #333; /* Adjust if needed for contrast */
}

/* Default box styling */
.box {
    padding: 15px;
    transition: box-shadow 0.3s ease-in-out; /* Smooth transition for the hover effect */
}

.col-lg-3 {
    flex: 0 0 25%; /* Shows 4 products per row */
    max-width: 40%;
}

/* Adds a shadow effect only when hovered */
.box:hover {
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Shadow appears on hover */
    transform: translateY(-3px); /* Slight lift effect */
}

/* Style for the "New" circle */
.new {
    background-color: #9e3636 !important; /* Change background color to red */
    color: white !important; /* Ensure the text inside remains visible */
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 50px; /* Makes it a rounded shape */
    display: inline-block;
    text-align: center;
}

</style>
<section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Dog's Clothes & Accessories
        </h2>
      </div>
      <div class="row">
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
          <a href="{{ route('product') }}">
          <a href="product/product1">
              <div class="img-box">

              <img src = "images/clothes1.png" alt="ring" style="width: 100%; height: auto;"></src>
            </div>
              <div class="detail-box">
                <h6>
                  Soft Fleece Jacket
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
                <img src="images/dclothes2.webp" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                  Heart Sleeves Jumper
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
                <img src="images/dclothes3.webp" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                  Dog Seat Belt 
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
                <img src="images/dclothes4.webp" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                  Cozy Knit Sweater
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
                <img src="images/dogclothes5.webp" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                  Bear Jumper
                </h6>
                <h6>
                  Price
                  <span>
                    £35
                  </span>
                </h6>
              </div>
            </a>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
          <a href="{{ route('product') }}">
          <a href="product/product11">
              <div class="img-box">
                <img src="images/dogclothes6.webp" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                 Puffer Jacket with Sherpa Fur
                </h6>
                <h6>
                  Price
                  <span>
                    £10
                  </span>
                </h6>
              </div>
            </a>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
          <a href="{{ route('product') }}">
          <a href="product/product13">
              <div class="img-box">
                <img src="images/dogclothes7.webp" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                 Chest Harness
                </h6>
                <h6>
                  Price
                  <span>
                    £20
                  </span>
                </h6>
              </div>
            </a>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
          <a href="{{ route('product') }}">
          <a href="product/product16">
              <div class="img-box">
                <img src="images/dogclothes8.webp" alt="p2" style="width: 100%; height: auto;"></src>
              </div>
              <div class="detail-box">
                <h6>
                 Polka Dot Scarf
                </h6>
                <h6>
                  Price
                  <span>
                    £50
                  </span>
                </h6>
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
