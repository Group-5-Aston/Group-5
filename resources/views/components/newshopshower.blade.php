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
          <a href="{{ route('product.show', ['product' => $product->product_id])}}">
              <div class="img-box">
              <img src = "{{ Storage::url($product['image']) }}" alt="ring">
            </div>
              <div class="detail-box">
                <h5>
                    {{ $product ->name }}
                </h5>
                <small>{{$product->averageRating()}}</small>
                  {!! $product->review_stars !!}
                <h4>
                  <span>
                    £{{ $product->price }}
                  </span>
                </h4>
              </div>
              @if ($product->isNew())
                  <div class="new">
                    <span>
                      New
                    </span>
                  </div>
              @endif
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
