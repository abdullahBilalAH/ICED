@php
$order = [
  'subTotal' => 0,
  'items' => [
    // Add items here if needed
  ],
  'discountCodes' => [
    'code' => session('discount_code', ""), // Retrieve discount code from session or default to an empty string
    'percent' => session('discount_percent', 0) // Retrieve discount percent from session or default to 0
  ]
];
@endphp
@extends("layouts.main")
@section("title")
cart
@endsection
@section("content")
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                     <table class="table">
                      <thead>
                          <tr>
                              <th class="shoping__product">Products</th>
                              <th>Price</th>
                              <th>Quantity</th>
                              <th>Total</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>

                          @foreach ($items as $item)
                              @php
                                  $cartItem = $cart[$item->id];
                                  $totalPrice = $cartItem['quantity'] * $item->price;
                                  $photoUrl = json_decode($item->photos)[0] ?? 'default-image.jpg';

                                  //order builder
                                  $order["subTotal"] += $totalPrice;
                                  $order["items"][] = $item->id ;
                              @endphp
                              <tr id="cart-item-{{ $item->id }}">
                                  <td class="shoping__cart__item">
                                      <img src="{{ asset('storage/' . $photoUrl) }}" alt="" style="width: 100px; height: 100px;">
                                      <h5>{{ $item->name }}</h5>
                                  </td>
                                  <td class="shoping__cart__price">
                                      ${{ number_format($item->price, 2) }}
                                  </td>
                                  <td class="shoping__cart__quantity">
                                   <form action="{{ route('cart.update') }}" method="POST" style="display: inline;">
                                       @csrf
                                       <input type="hidden" name="id" value="{{ $item->id }}">
                                       <div class="input-group">
                                           <input type="number" name="quantity" value="{{ $cartItem['quantity'] }}" min="1" class="form-control" style="max-width: 80px;">
                                           <div class="input-group-append">
                                               <button type="submit" class="btn btn-success" style="background-color: #7FAD39; border: none; color: white; padding: 0.375rem 0.75rem;">
                                                   <i class="bi bi-arrow-right" style="font-size: 1rem;"></i> Update
                                               </button>
                                           </div>
                                       </div>
                                   </form>
                               </td>
                               
                                  <td class="shoping__cart__total">
                                      ${{ number_format($totalPrice, 2) }}
                                  </td>
                                  <td class="shoping__cart__item__close">
                                   <form action="{{ route('cart.remove') }}" method="POST" style="display: inline;">
                                       @csrf
                                       <input type="hidden" name="id" value="{{ $item->id }}">
                                       <button type="submit" class="btn p-0" style="border: 2px solid #7FAD39; background-color: white; color: #7FAD39; border-radius: 50%; padding: 5px 10px; cursor: pointer;" title="Remove item">
                                           <i class="bi bi-x" style="font-size: 1.5rem;"></i>
                                       </button>
                                   </form>
                               </td>
                               

                              </tr>
                          @endforeach
                      </tbody>
                  </table>
                  
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{route("dashboard")}}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    </div>
                </div>
                <div class="col-lg-6">
                 <div class="shoping__continue">
                     <div class="shoping__discount">
                         <h5>Discount Codes</h5>
                         
                         <!-- Display success or error messages -->
                         @if (session('success'))
                             <div class="alert alert-success">
                                 {{ session('success') }}
                                 @if (session('discount'))
                                     <p>Code: {{ session('discount.code') }}</p>
                                     <p>Discount: {{ session('discount.percent') }}%</p>
                                 @endif
                             </div>
                         @endif
             
                         @if (session('error'))
                             <div class="alert alert-danger">
                                 {{ session('error') }}
                             </div>
                         @endif
             
                         <!-- Discount Code Form -->
                         <form action="{{ route('apply.coupon') }}" method="POST">
                             @csrf
                             <input type="text" name="code" placeholder="Enter your coupon code" required>
                             <button type="submit" class="site-btn">APPLY COUPON</button>
                         </form>
                     </div>
                 </div>
             </div>
             
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span>${{$order["subTotal"]}}</span></li>
                            <li>Discount <span style="color: #7FAD39;">{{$order["discountCodes"]["percent"]}}%</span></li>
                            <li>Total <span>${{$order["subTotal"]-($order["subTotal"] * ($order["discountCodes"]["percent"])/100.0)}}</span></li>
                        </ul>
                        <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection
