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
                         $rating=0;
                         foreach ($reviews as $review) {
                          $rating += $review->rating;
                         }
                         if($review->count()!=0){
                         $rating /= $review->count();
                        }else{
                         $rating =0;
                        }
                         $rating = number_format($rating,2);
                         $nonRating =number_format($rating,1);
                         $nonRating =5-$rating;

                         @endphp
                         @for(;$rating>1;$rating-=1)
                            <i class="fa fa-star"></i>
                         @endfor
                         @if($rating<1&&$rating>0)
                            <i class="fa fa-star-half-o"></i>
                         @endif


                         @for(;$nonRating>1;$nonRating-=1)
                          <i class="fa fa-star-o"></i>
                         @endfor
                            <span>({{$reviews->count()}})</span>
                        </div>
                        <div class="product__details__price">${{$item->price}}</div>
                        <p>{{$item->description}}</p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1">
                                </div>
                            </div>
                        </div>
                        <a href="#" class="primary-btn">ADD TO CARD</a>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <ul>

                          @php
                           $stock= "In Stock";
                           if($item->quantity<0){
                            $stock="Out Of Stock ";
                           }
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
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
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
                                    <h6>Products Infomation</h6>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 @endsection