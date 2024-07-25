@extends("layouts.main")
@section("title")
{{$item->name}}
@endsection

@section("content")
    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            @if (!empty($item->photos) && count(json_decode($item->photos)) > 0)
                                <img class="product__details__pic__item--large"
                                    src="{{ asset('storage/' . json_decode($item->photos)[0]) }}" alt="">
                            @else
                                <img class="product__details__pic__item--large"
                                    src="img/product/details/default.jpg" alt="Default Image">
                            @endif
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            @if (!empty($item->photos))
                                @foreach (json_decode($item->photos) as $photo)
                                    <img data-imgbigurl="{{ asset('storage/' . $photo) }}" src="{{ asset('storage/' . $photo) }}" alt="">
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{$item->name}}</h3>
                        <div class="product__details__rating">
                            @php
                                $rating = 0;
                                $reviewCount = $reviews->count();
                                foreach ($reviews as $review) {
                                    $rating += $review->rating;
                                }
                                $rating = $reviewCount > 0 ? $rating / $reviewCount : 0;
                                $rating = number_format($rating, 2);
                                $nonRating = 5 - $rating;
                            @endphp
                            @for ($i = 0; $i < floor($rating); $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                            @if ($rating - floor($rating) > 0)
                                <i class="fa fa-star-half-o"></i>
                            @endif
                            @for ($i = 0; $i < floor($nonRating); $i++)
                                <i class="fa fa-star-o"></i>
                            @endfor
                            <span>({{$reviewCount}})</span>
                        </div>
                        <div class="product__details__price">${{$item->price}}</div>
                        <p>{{$item->description}}</p>
                        <div class="product__details__quantity">
                         <div class="product__details__quantity">
                          <form action="{{ route('cart.add') }}" method="POST">
                              @csrf
                              <input type="hidden" name="item_id" value="{{ $item->id }}">
                              <div class="input-group mb-3">
                                  <button type="button" class="btn btn-outline-secondary" onclick="decrement()">-</button>
                                  <input type="text" id="quantityInput" name="quantity" class="form-control text-center" value="1" readonly>
                                  <button type="button" class="btn btn-outline-secondary" onclick="increment()">+</button>
                              </div>
                              <button type="submit" class="btn" style="background-color: #7FAD39; color: white;">ADD TO CART</button>
                          </form>
                      </div>
                      @if (in_array($item->id, $favorites))
                      <!-- When the item is already in favorites (green heart) -->
                      <form action="{{ route('favorites.remove') }}" method="POST" style="display: inline;">
                          @csrf
                          <input type="hidden" name="id" value="{{ $item->id }}">
                          <button type="submit" class="d-inline-block" style="width: 24px; height: 24px; background: none; border: none; padding: 0;">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#7FAD39" class="bi bi-heart-fill" style="width: 100%; height: 100%;">
                                  <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                              </svg>
                          </button>
                      </form>
                  @else
                      <!-- When the item is not in favorites (white heart with green border) -->
                      <a href="{{ route('favorites.add', ['id' => $item->id]) }}" class="d-inline-block" style="width: 24px; height: 24px;">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#FFFFFF" stroke="#7FAD39" stroke-width="2" class="bi bi-heart" style="width: 100%; height: 100%;">
                              <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                          </svg>
                      </a>
                  @endif
                  
                  
                  
                        <ul>
                            @php
                                $stock = $item->quantity > 0 ? "In Stock" : "Out Of Stock";
                            @endphp
                            <li><b>Availability</b> <span>{{$stock}}</span></li>
                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>({{ $reviews->count() }})</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Product Information</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Reviews</h6>
                                    <!-- Reviews section -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
    var maxQuantity = @json($item->quantity); // Maximum available quantity

    function increment() {
        var quantityInput = document.getElementById('quantityInput');
        var currentValue = parseInt(quantityInput.value);
        if (currentValue < maxQuantity) {
            quantityInput.value = currentValue + 1;
        }
    }

    function decrement() {
        var quantityInput = document.getElementById('quantityInput');
        var currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    }
</script>
