@extends('layouts.app')

@section("title")
{{$item->name}}
@endsection
@section("content")
    <div class="container mt-5">
        <h2>Item Details</h2>

        <form method="POST" action="" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" class="form-control" id="id" name="id" value="{{ $item->id }}" readonly>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}">
            </div>

            <div class="form-group">
             <label for="price">slug:</label>
             <input type="text" class="form-control" id="slug" name="slug" value="{{ $item->slug }}">
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $item->price }}">
            </div>
        
            <div class="form-group">
                <label for="type">description:</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ $item->description }}">
            </div>
        
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{$item->quantity}}">
            </div>
        
            <div class="form-group">
             <div class="col-lg-6 col-md-6">
              <div class="product__details__pic">
                  <div class="product__details__pic__item">
                      @if (!empty($item->photos) && count(json_decode($item->photos)) > 0)
                          <img class="img-fluid" src="{{ asset('storage/' . json_decode($item->photos)[0]) }}" alt="Product Image">
                      @else
                          <img class="img-fluid" src="img/product/details/default.jpg" alt="Default Image">
                      @endif
                  </div>
                  <div class="col-lg-6 col-md-6">
                   <div class="product__details__pic">
                       <div class="product__details__pic__item">
                           @if (!empty($item->photos) && count(json_decode($item->photos)) > 0)
                               <img class="product__details__pic__item--large"
                                    src="{{ asset('storage/' . json_decode($item->photos)[0]) }}" 
                                    alt="Product Image">
                           @else
                               <img class="product__details__pic__item--large"
                                    src="img/product/details/default.jpg" 
                                    alt="Default Image">
                           @endif
                       </div>
                       <div class="product__details__pic__slider owl-carousel">
                           @if (!empty($item->photos))
                               @foreach (json_decode($item->photos) as $photo)
                                   <img data-imgbigurl="{{ asset('storage/' . $photo) }}" 
                                        src="{{ asset('storage/' . $photo) }}" 
                                        class="product__details__pic__slider--item" 
                                        alt="Product Thumbnail">
                               @endforeach
                           @endif
                       </div>
                   </div>
               </div>
               
              </div>
          </div>
          
            </div>
        
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        
        
        <br/>
        <form method="POST" action="">
            @csrf
            @method("Delete")
            <button type="submit"  class="btn btn-danger">Delete</button>
        </form>
        <br/>
        <a href="" class="btn btn-secondary">Back to Items</a>
    </div>
@endsection