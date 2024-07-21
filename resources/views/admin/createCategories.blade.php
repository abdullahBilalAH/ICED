@extends("layouts.app")

@section('title')
create Category
@endsection

@section('content')
                <!-- End of Topbar -->
                <form method="POST" action="{{route('categories.create')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                      <label for="name">Name:</label>
                      <input type="text" class="form-control" id="name" name="name" value="">
                  </div>
              
                  <div class="form-group">
                      <label for="price">Slug:</label>
                      <input type="text" class="form-control" id="slug" name="slug" value="">
                  </div>
              
                  <div class="form-group">
                      <label for="type">Description:</label>
                      <input type="text" class="form-control" id="description" name="description" value="">
                  </div>

                  <div class="form-group">
                   <label for="photo">Photo:</label>
                   <input type="file" class="form-control-file" id="photo" name="photo">
               </div>
                  <button type="submit" class="btn btn-primary">store</button>
              </form>
                <!-- Begin Page Content -->
@endsection