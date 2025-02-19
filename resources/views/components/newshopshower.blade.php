@props(['products'])

<section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
            {{ $slot }}
        </h2>
      </div>
      <div class="row">
          @foreach($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
          <a href="{{ route('product', ['product' => $product->product_id]) }}">
              <div class="img-box">
              <img src = "{{ Storage::url($product['image']) }}" alt="ring" style="width: 100%; height: auto;">
            </div>
              <div class="detail-box">
                <h6>
                    {{ $product ->name }}
                </h6>
                <h6>
                  Price
                  <span>
                    £{{ $product->price }}
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
          @endforeach
      <div class="btn-box">
        <a href="{{ route('fullshop') }}">
          Return to Main Products Page
        </a>
      </div>
    </div>
    </div>
  </section>
