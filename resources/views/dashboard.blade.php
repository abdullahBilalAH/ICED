@extends("layouts.main")
@section("title")
home page
@endsection
                    @section("hero_item")
                    <div class="hero__item set-bg" data-setbg="{{ Storage::url($mainInfo['hero_page']['img']) }}">
                     <div class="hero__text">
                         <h2>{{ $mainInfo['hero_page']['txt'] }}</h2>
                         <a href="{{route('getItemsByCategoryId',$mainInfo['hero_page']['category'])}}" class="primary-btn">SHOP NOW</a>
                     </div>
                 </div>
                     @endsection                 
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

  <!-- content -->
  @section("content")
    <!-- Categories Section Begin -->
    <section class="categories">
     <div class="container">
         <div class="row">
             <div class="categories__slider owl-carousel">
                 @foreach($categoriesScroll as $category)
                 <div class="col-lg-3">
                  <div class="categories__item set-bg" data-setbg="{{ asset('storage/photos/' . $category->photos) }}">
                      <h5><a href="{{route('getItemsByCategoryId',$category->id)}}">{{ $category->name }}</a></h5>
                  </div>
              </div>
              
                 @endforeach
             </div>
         </div>
     </div>
 </section>
 
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
     <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="section-title">
                     <h2>Featured Product</h2>
                 </div>
                 <div class="featured__controls">
                     <ul>
                         <li class="active" data-filter="*">all</li>
                         @foreach($featuredSection as $category)
                         @php
                             $dataFilter = str_replace("-", ", .", $category->slug)
                         @endphp
                         <li data-filter=".{{ $dataFilter }}">{{ $category->name }}</li>
                         @endforeach
                     </ul>
                 </div>
             </div>
         </div>
<div class="row featured__filter">
    @foreach($items as $item)
    <div class="col-lg-3 col-md-4 col-sm-6 mix {{ $item->slug }}">
        <div class="featured__item">
            @php
                $photosArray = json_decode($item->photos, true);
                $firstPhoto = $photosArray[0] ?? null;
            @endphp

            <div class="featured__item__pic set-bg" data-setbg="{{ $firstPhoto ? asset('storage/' . $firstPhoto) : asset('storage/default-image.jpg') }}">
                <ul class="featured__item__pic__hover">
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
            </div>

            <div class="featured__item__text">
                <h6><a href="{{route("item.index",$item->id)}}">{{ $item->name }}</a></h6>
                <h5>${{ $item->price }}</h5>
            </div>
        </div>
    </div>
    @endforeach
</div>

     </div>
 </section>
 
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
     <div class="container">
         <div class="row">
             <div class="col-lg-6 col-md-6 col-sm-6">
                 <div class="banner__pic">
                    <a href="{{route('getItemsByCategoryId',$mainInfo['banner1']['category'])}}"> <img src="{{ Storage::url($mainInfo['banner1']['img']) }}" alt="Banner 1"></a>
                 </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6">
                 <div class="banner__pic">
                  <a href="{{route('getItemsByCategoryId',$mainInfo['banner2']['category'])}}"> 
                     <img src="{{ Storage::url($mainInfo['banner2']['img']) }}" alt="Banner 2">
                  </a>
                 </div>
             </div>
         </div>
     </div>
 </div>
 
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div class="latest-product__slider owl-carousel">
                         <div class="latest-prdouct__slider__item">
                          @php
                          $first3Items = $last6Items->take(3);
                          $last3Items = $last6Items->slice(-3);
                          @endphp
                             @foreach($last6Items->take(3) as $item)
                             @php
                              $photos = json_decode($item->photos);
                              $firstPhoto = $photos[0];
                             @endphp
                             <a href="{{route("item.index",$item->id)}}" class="latest-product__item">
                                 <div class="latest-product__item__pic">
                                     <img src="{{ asset('storage/' . $firstPhoto) }}" alt="">
                                 </div>
                                 <div class="latest-product__item__text">
                                     <h6>{{$item->name}}</h6>
                                     <span>{{$item->price}}</span>
                                 </div>
                             </a>
                             @endforeach
                             
                         </div>
                         <div class="latest-prdouct__slider__item">
                          @foreach($last6Items->slice(-3) as $item)
                          @php
                          $photos = json_decode($item->photos);
                          $firstPhoto = $photos[0];
                          
                          @endphp
                          <a href="{{route("item.index",$item->id)}}" class="latest-product__item">
                              <div class="latest-product__item__pic">
                                  <img src="{{ asset('storage/' . $firstPhoto) }}" alt="">
                              </div>
                              <div class="latest-product__item__text">
                                  <h6>{{$item->name}}</h6>
                                  <span>{{$item->price}}</span>
                              </div>
                          </a>
                          @endforeach
                          
                             </a>
                         </div>
                        
                     </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->
    <!-- end content -->
    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-1.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Cooking tips make cooking simple</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-2.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-3.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Visit the clean farm in the US</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
    @endsection
