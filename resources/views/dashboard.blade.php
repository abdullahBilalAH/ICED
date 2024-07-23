@php
    // Extract IDs from mainInfo arrays
    $categoriesScrollIds = $mainInfo['categories_scroll'] ?? [];
    $featuredSectionIds = $mainInfo['Featured Section'] ?? [];

    // Convert categories to a keyed array by ID for easy lookup
    $categoriesById = $categories->keyBy('id');

    // Filter categories based on the IDs in mainInfo
    $categoriesScroll = $categories->filter(function ($category) use ($categoriesScrollIds) {
        return in_array($category->id, $categoriesScrollIds);
    });

    $featuredSection = $categories->filter(function ($category) use ($featuredSectionIds) {
        return in_array($category->id, $featuredSectionIds);
    });
@endphp
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

  <!-- Css Styles -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
 </head>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.html">Home</a></li>
                <li><a href="./shop-grid.html">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.html">Shop Details</a></li>
                        <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                        <li><a href="./checkout.html">Check Out</a></li>
                        <li><a href="./blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="./blog.html">Blog</a></li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> {{$info['email']}}</li>
                <li>{{$info['news']}}</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> {{$info['email']}}</li>
                                <li>{{$info['news']}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <img src="img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanis</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="#"><i class="fa fa-user"></i> Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index.html">Home</a></li>
                            <li><a href="./shop-grid.html">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="./blog.html">Blog</a></li>
                            <li><a href="./contact.html">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                        </ul>
                        <div class="header__cart__price">item: <span>$150.00</span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All departments</span>
                        </div>
                        <ul>
                         @foreach($categories as $categorie)
                         <li><a href="{{route('getItemsBySlug',$categorie->slug)}}">{{$categorie->name}}</a></li>
                         @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>{{$info["phone"]}}</h5>
                                <span>{{$info["support_time"]}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" data-setbg="{{ Storage::url($mainInfo['hero_page']['img']) }}">
                     <div class="hero__text">
                         <h2>{{ $mainInfo['hero_page']['txt'] }}</h2>
                         <a href="{{route('getItemsByCategoryId',$mainInfo['hero_page']['category'])}}" class="primary-btn">SHOP NOW</a>
                     </div>
                 </div>
                 
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

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

    <!-- Footer Section Begin -->
    <footer class="footer spad">
     <div class="container">
         <div class="row">
             <div class="col-lg-3 col-md-6 col-sm-6">
                 <div class="footer__about">
                     <div class="footer__about__logo">
                         <a href="./index.html"><img src="img/logo.png" alt=""></a>
                     </div>
                     <ul>
                         <li>Address: {{$info["address"]}}</li>
                         <li>Phone: {{$info["phone"]}}</li>
                         <li>Email: {{$info['email']}}</li>
                     </ul>
                 </div>
             </div>
             <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
              <div class="footer__widget">
                  <h6>Useful Links</h6>
                  <ul>
                      <li><a href="{{route("page.view",$links["page1"])}}">{{$links["page1"]}}</a></li>
                      <li><a href="{{route("page.view",$links["page2"])}}">{{$links["page2"]}}</a></li>                            
                      <li><a href="{{route("page.view",$links["page3"])}}">{{$links["page3"]}}</a></li>
                      <li><a href="{{route("page.view",$links["page4"])}}">{{$links["page4"]}}</a></li>                            <li><a href="{{route("page.view",$links["page5"])}}">{{$links["page5"]}}</a></li>                            <li><a href="{{route("page.view",$links["page6"])}}">{{$links["page6"]}}</a></li>
                  </ul>
                  <ul>
                   <li><a href="{{route("page.view",$links["page7"])}}">{{$links["page7"]}}</a></li>                            
                   <li><a href="{{route("page.view",$links["page8"])}}">{{$links["page8"]}}</a></li>                            <li><a href="{{route("page.view",$links["page9"])}}">{{$links["page9"]}}</a></li>                            <li><a href="{{route("page.view",$links["page9"])}}">{{$links["page9"]}}</a></li>                            <li><a href="{{route("page.view",$links["page10"])}}">{{$links["page10"]}}</a></li>                            <li><a href="{{route("page.view",$links["page11"])}}">{{$links["page11"]}}</a></li>                        
                   <li><a href="{{route("page.view",$links["page12"])}}">{{$links["page12"]}}</a></li>
                  </ul>

              </div>
          </div>
             <div class="col-lg-4 col-md-12">
                 <div class="footer__widget">
                     <h6>Join Our Newsletter Now</h6>
                     <p>Get E-mail updates about our latest shop and special offers.</p>
                     <form action="#">
                         <input type="text" placeholder="Enter your mail">
                         <button type="submit" class="site-btn">Subscribe</button>
                     </form>
                     <div class="footer__widget__social">
                         <a href="#"><i class="fa fa-facebook"></i></a>
                         <a href="#"><i class="fa fa-instagram"></i></a>
                         <a href="#"><i class="fa fa-twitter"></i></a>
                         <a href="#"><i class="fa fa-pinterest"></i></a>
                     </div>
                 </div>
             </div>
         </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
<!-- JavaScript Files -->
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('js/mixitup.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

</body>

</html>