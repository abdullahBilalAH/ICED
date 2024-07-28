@extends('layouts.main')

@section("title")
checkout
@endsection

@section("content")

    <!-- Header Section End -->
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
     <div class="container">
         <div class="row">
             <div class="col-lg-12 text-center">
                 <div class="breadcrumb__text">
                     <h2>Checkout</h2>
                     <div class="breadcrumb__option">
                         <a href="./index.html">Home</a>
                         <span>Checkout</span>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- Breadcrumb Section End -->

 <!-- Checkout Section Begin -->
 <section class="checkout spad">
     <div class="container">
         <div class="checkout__form">
             <h4>Billing Details</h4>
<form action="{{ route('checkout.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-8 col-md-6">
            <div class="checkout__input">
                <p>Country<span>*</span></p>
                <input type="text" name="country" required>
            </div>
            <div class="checkout__input">
                <p>Address<span>*</span></p>
                <input type="text" placeholder="Street Address" class="checkout__input__add" name="streetAddress" required>
                <input type="text" placeholder="Apartment, suite, unit etc (optional)" name="apartment">
            </div>
            <div class="checkout__input">
                <p>Town/City<span>*</span></p>
                <input type="text" name="city" required>
            </div>
            <div class="checkout__input">
                <p>Country/State<span>*</span></p>
                <input type="text" name="state" required>
            </div>
            <div class="checkout__input">
                <p>Postcode / ZIP<span>*</span></p>
                <input type="text" name="postcode" required>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="checkout__input">
                        <p>Phone<span>*</span></p>
                        <input type="text" name="phone" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="checkout__input">
                        <p>Email<span>*</span></p>
                        <input type="email" name="email" required>
                    </div>
                </div>
            </div>
            <div class="checkout__input">
                <p>Order notes</p>
                <input type="text" placeholder="Notes about your order, e.g. special notes for delivery." name="orderNotes">
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="checkout__order">
                <h4>Your Order</h4>
                <div class="checkout__order__products">Discount <span style="color: #7FAD39;">{{ $order['discountCodes']['percent'] }}%</span></div>
                <div class="checkout__order__subtotal">Subtotal <span>${{ $order['subTotal'] }}</span></div>
                <div class="checkout__order__total">Total <span>${{ $order['subTotal'] - ($order['subTotal'] * ($order['discountCodes']['percent'] / 100.0)) }}</span></div>
                <button type="submit" class="site-btn">PLACE ORDER</button>
            </div>
        </div>
    </div>
</form>

         </div>
     </div>
 </section>
 <!-- Checkout Section End -->

@endsection
