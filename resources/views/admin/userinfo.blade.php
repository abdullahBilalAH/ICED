@extends('layouts.app')
@section('content')
<figure class="text-center">
 <blockquote class="blockquote">
   <p>you can change this information</p>
 </blockquote>
</figure><!-- resources/views/userinfo/index.blade.php -->
<form action="{{ route('userinfo.update') }}" method="POST" class="mt-4">
 @csrf
 <div class="form-group">
     <label for="email">Email:</label>
     <input type="email" id="email" name="email" class="form-control" value="{{ $info['email'] }}">
 </div>
 <div class="form-group">
     <label for="phone">Phone:</label>
     <input type="text" id="phone" name="phone" class="form-control" value="{{ $info['phone'] }}">
 </div>
 <div class="form-group">
     <label for="address">Address:</label>
     <input type="text" id="address" name="address" class="form-control" value="{{ $info['address'] }}">
 </div>
 <div class="form-group">
     <label for="news">News:</label>
     <input type="text" id="news" name="news" class="form-control" value="{{ $info['news'] }}">
 </div>
 <div class="form-group">
     <label for="support_time">Support Time:</label>
     <input type="text" id="support_time" name="support_time" class="form-control" value="{{ $info['support_time'] }}">
 </div>
 <div class="form-group">
     <label for="open_time">Open Time:</label>
     <input type="text" id="open_time" name="open_time" class="form-control" value="{{ $info['open_time'] }}">
 </div>
 <div class="form-group">
     <label for="location">Location:</label>
     <input type="text" id="location" name="location" class="form-control" value="{{ $info['location'] }}">
 </div>
 <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
