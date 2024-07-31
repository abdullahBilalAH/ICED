@extends('layouts.main')

@section('title','contact')

@section('content')
<body>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Contact Us</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Contact Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>Phone</h4>
                        <p>{{$info["phone"]}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Address</h4>
                        <p>{{$info["address"]}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_clock_alt"></span>
                        <h4>Open time</h4>
                        <p>{{$info['open_time']}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>Email</h4>
                        <p>{{$info['email']}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Map Begin -->
    <div class="map">
     <iframe src="{{$info['location']}}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <div class="map-inside">
            <i class="icon_pin"></i>
            <div class="inside-widget">
                <h4>Amman</h4>
                <ul>
                    <li>Phone: {{$info['phone']}}</li>
                    <li>Add: {{$info['address']}}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Map End -->

    <!-- Contact Form Begin -->
    <div class="contact-form spad">
     <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="contact__form__title">
                     <h2>Leave Message</h2>
                 </div>
             </div>
         </div>
         @if(session('success'))
             <div class="alert alert-success">
                 {{ session('success') }}
             </div>
         @endif
         <form action="{{ route('contact.submit') }}" method="POST">
             @csrf
             <div class="row">
                 <div class="col-lg-6 col-md-6">
                     <input type="text" name="name" placeholder="Your name" required>
                 </div>
                 <div class="col-lg-6 col-md-6">
                     <input type="email" name="email" placeholder="Your Email" required>
                 </div>
                 <div class="col-lg-12 text-center">
                     <textarea name="message" placeholder="Your message" required></textarea>
                     <button type="submit" class="site-btn">SEND MESSAGE</button>
                 </div>
             </div>
         </form>
     </div>
 </div>
    <!-- Contact Form End -->

    @endsection