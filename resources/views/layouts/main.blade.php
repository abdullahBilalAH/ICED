@php
$cost =0;
foreach ($cart as $item) {
 $cost += $item["price"]*$item["quantity"];
}
@endphp
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- Css Styles -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
  <style>
   .hero__search__phone__icon {
       display: flex;
       align-items: center;
       justify-content: center;
       width: 50px; /* Adjust the width to fit your design */
       height: 50px; /* Adjust the height to fit your design */
       background-color: #f1f1f1; /* Adjust the background color as needed */
       border-radius: 50%; /* This creates the circle */
   }
   
   .hero__search__phone__icon i {
       font-size: 20px; /* Adjust the font size as needed */
       color: #7FAD39; /* Adjust the icon color as needed */
   }
</style>
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
                <li><a href="/1212"><i class="fa fa-shopping-bag"></i> <span>1</span></a></li>
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
                             <div class="dropdown">
                                 <a href="#" class="dropdown-toggle" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     <i class="fa fa-user"></i> {{$user->name}}
                                 </a>
                                 <div class="dropdown-menu" aria-labelledby="userDropdown">
                                     @if($user->user_type == 'admin')
                                         <a class="dropdown-item" href="{{ route('adminDashboard') }}">
                                             Admin Page
                                         </a>
                                     @endif
                                     <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                         Logout
                                     </a>
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                         @csrf
                                     </form>
                                 </div>
                             </div>
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
                            <li><a href="{{route('favorites.index')}}"><i class="fa fa-heart"></i> <span>{{count($favorites)}}</span></a></li>
                            <li><a href="{{route('cart.index')}}"><i class="fa fa-shopping-bag"></i> <span>{{count($cart)}}</span></a></li>
                        </ul>

                        <div class="header__cart__price">item: <span>${{$cost}}</span></div>
                    </div>
                </div>
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
                         <li><a href="{{ route('getItemsBySlug', $categorie->slug) }}">{{ $categorie->name }}</a></li>
                         @endforeach
                     </ul>
                 </div>
             </div>
             <div class="col-lg-9">
                 <div class="hero__search">
                     <div class="hero__search__form">
                         <form action="#">
                             {{-- <div class="hero__search__categories">
                                 All Categories
                             </div> --}}
                             <input type="text" placeholder="What do you need?">
                             <button type="submit" class="site-btn">SEARCH</button>
                         </form>
                     </div>
                     <div class="hero__search__phone">
                         <div class="hero__search__phone__icon">
                             <i class="fa fa-phone"></i>
                         </div>
                         <div class="hero__search__phone__text">
                             <h5>{{ $info["phone"] }}</h5>
                             <span>{{ $info["support_time"] }}</span>
                         </div>
                     </div>
                 </div>
                 @yield("hero_item")
             </div>
         </div>
     </div>
 </section>
 
 
    @yield("content")

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
                   <li><a href="{{route("page.view",$links["page4"])}}">{{$links["page4"]}}</a></li>                          <li><a href="{{route("page.view",$links["page5"])}}">{{$links["page5"]}}</a></li>                    
                   <li><a href="{{route("page.view",$links["page6"])}}">{{$links["page6"]}}</a></li>
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
                     {{-- <div class="footer__widget__social">
                         <a href="#"><i class="fa fa-facebook"></i></a>
                         <a href="#"><i class="fa fa-instagram"></i></a>
                         <a href="#"><i class="fa fa-twitter"></i></a>
                         <a href="#"><i class="fa fa-pinterest"></i></a>
                     </div> --}}
                 </div>
             </div>
         </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved 
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')

</body>

</html>