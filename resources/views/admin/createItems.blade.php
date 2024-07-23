@extends("layouts.app")

@section('title')
create Item
@endsection

@section('content')
<div class="card shadow mb-4">
 <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary">Add Item</h6>
 </div>
 <div class="card-body">
     <div class="chart-area">
         <form method="POST" action="{{route('items.store')}}" enctype="multipart/form-data">
             @csrf
             @method("POST")
             <div class="form-group">
                 <label for="name">Name:</label>
                 <input type="text" class="form-control" id="name" name="name" value="" required>
             </div>
         
             <div class="form-group">
                 <label for="price">Price:</label>
                 <input type="number" step=".01" class="form-control" id="price" name="price" value="" required>
             </div>
         
             <div class="form-group">
                 <label for="type">slug:</label>
                 <input type="text" class="form-control" id="slug" name="slug" value="" required>
             </div>
         
             <div class="form-group">
                 <label for="quantity">description:</label>
                 <input type="text" class="form-control" id="description" name="description" value="" required>
             </div>
             <div class="form-group">
                 <label for="quantity">Quantity:</label>
                 <input type="number" class="form-control" id="quantity" name="quantity" value="" required>
             </div>
         
             <div class="form-group">
              <label for="photos">Photos:</label>
              <input type="file" class="form-control-file" id="photos" name="photos[]" accept="image/*" multiple required>
          </div>
         
             <button type="submit" class="btn btn-primary">Submit</button>
         </form>
         
 </div>
</div>
@endsection