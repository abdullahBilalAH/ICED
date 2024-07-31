@extends('layouts.main')

@section('title', 'Search Results')

@section('content')
    <div class="container">
        <h1>Search Results for "{{ $query }}"</h1>

        <h2>Items</h2>
        @if($items->isEmpty())
            <p>No items found.</p>
        @else
            <form method="GET" action="{{ route('search.results') }}" id="sort-form">
                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="filter__sort">
                                <span>Sort By</span>
                                <select name="sort" onchange="document.getElementById('sort-form').submit();">
                                    <option value="0" {{ request('sort') == '0' ? 'selected' : '' }}>Default</option>
                                    <option value="1" {{ request('sort') == '1' ? 'selected' : '' }}>Price (Low to High)</option>
                                    <option value="2" {{ request('sort') == '2' ? 'selected' : '' }}>Price (High to Low)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h6><span>{{ $items->count() }}</span> Products found</h6>
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
            </form>
            <div class="row">
                @foreach($items as $item)
                @php
                    $photos = json_decode($item->photos);
                    $firstPhoto = $photos[0] ?? 'default-image.jpg';
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
                            <h6><a href="{{ route('item.index', $item->id) }}">{{ $item->name }}</a></h6>
                            <h5>${{ $item->price }}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

        <h2>Categories</h2>
        @if($categories->isEmpty())
            <p>No categories found.</p>
        @else
            <div class="row">
                @foreach($categoriesSearch as $category)
                @php
                    $categoryPhoto = $category->photos ?? 'default-category.jpg';
                @endphp
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="category__item">
                        <div class="category__item__pic set-bg" data-setbg="{{ asset('storage/' . $categoryPhoto) }}">
                            <a href="{{ route('getItemsByCategoryId', $category->id) }}">
                             <h1 style="color: #28a745; font-weight: bold;">{{ $category->name }}</h1>
                            </a>
                        </div>
                    </div>
                </div>
                <br/>

                @endforeach
            </div>
        @endif
    </div>
@endsection
