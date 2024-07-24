@extends("layouts.main")

@section("title")
search
@endsection
{{-- @dd($categories, $last6Items, $info,  $links, $mainInfo, $items, $categoriesById,$categoriesScroll,$featuredSection, $user) --}}
@section("content")
    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">

                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="10" data-max="540">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item sidebar__item__color--option">
                            <h4>Colors</h4>
                            <div class="sidebar__item__color sidebar__item__color--white">
                                <label for="white">
                                    White
                                    <input type="radio" id="white">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--gray">
                                <label for="gray">
                                    Gray
                                    <input type="radio" id="gray">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--red">
                                <label for="red">
                                    Red
                                    <input type="radio" id="red">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--black">
                                <label for="black">
                                    Black
                                    <input type="radio" id="black">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--blue">
                                <label for="blue">
                                    Blue
                                    <input type="radio" id="blue">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--green">
                                <label for="green">
                                    Green
                                    <input type="radio" id="green">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Popular Size</h4>
                            <div class="sidebar__item__size">
                                <label for="large">
                                    Large
                                    <input type="radio" id="large">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    Medium
                                    <input type="radio" id="medium">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    Small
                                    <input type="radio" id="small">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    Tiny
                                    <input type="radio" id="tiny">
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                 <div class="section-title product__discount__title">
                     <h2>departemnt name </h2>
                 </div>
             <div class="filter__item">
                 <div class="row">
                     <div class="col-lg-4 col-md-5">
                         <div class="filter__sort">
                             <span>Sort By</span>
                             <select>
                                 <option value="0">Default</option>
                                 <option value="0">Default</option>
                             </select>
                         </div>
                     </div>
                     <div class="col-lg-4 col-md-4">
                         <div class="filter__found">
                             <h6><span>{{$items->count()}}</span> Products found</h6>
                         </div>
                     </div>
                     <div class="col-lg-4 col-md-3">
                         <div class="filter__option">
                             <span class="icon_grid-2x2"></span>
                             <span class="icon_ul"></span>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="row">
             @foreach($items as $item)
             @php
             $photos = json_decode($item->photos);
             $firstPhoto = $photos[0];
         @endphp
         
         <div class="col-lg-4 col-md-6 col-sm-6">
             <div class="product__item">
              
              <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $firstPhoto) }}">
                     <ul class="product__item__pic__hover">
                         <li><a href="#"><i class="fa fa-heart"></i></a></li>
                         <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                         <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                     </ul>
                 </div>
                 <div class="product__item__text">
                     <h6><a href="{{route('item.index',$item->id)}}">{{ $item->name }}</a></h6>
                     <h5>${{ $item->price }}</h5>
                 </div>
             </div>
         </div>
         
             @endforeach

            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection