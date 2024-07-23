@extends("layouts.app")

@section('title')
Items
@endsection

@section('content')
<div class="card shadow mb-4">
 <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary">All Items</h6>
 </div>
 <div class="container mt-5 d-flex justify-content-center">
   <a href="{{route('items.create')}}" class="btn btn-primary">Create Item</a>
 </div>
  <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
              <tr>
                  <th>id</th>
                  <th>name</th>
                  <th>slug</th>
                  <th>price</th>
                  <th>description</th>
                  <th>quantity</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tfoot>
              <tr>
               <th>id</th>
               <th>name</th>
               <th>slug</th>
               <th>price</th>
               <th>description</th>
               <th>quantity</th>
               <th>Action</th>
              </tr>
          </tfoot>
          <tbody>

              @foreach ($items as $item)
              <tr>
                  <td class="mt-2 text-muted font-weight-bold">{{ $item->id }}</td>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->slug }}</td>
                  <td>{{ $item->price }}</td>
                  <td>{{ $item->description }}</td>
                  <td>{{ $item->quantity }}</td>
                  <td>
                      <form method="GET" action="{{route('admin.item.index',$item->id)}}">
                          @csrf
                      <button type="submit" class="btn btn-primary" role="button" aria-disabled="true">Show</button>
                      </form>
                  </td>
              </tr>
              @endforeach
          

          </tbody>
      </table>
  </div>
</div>
@endsection