@extends("layouts.app")

@section('title')
creator
@endsection

@section('content')
<figure class="text-center">
 <blockquote class="blockquote">
  <p>Here you can create pages with any content you want.</p>
  <p>We have two ways to make pages:</p>
  <p>First, by just providing a title and content.</p>
  <p>But if you want a more complex page, you can inject some HTML code. This will be placed inside the main layout of the website.</p>
 </blockquote>
</figure>

<div class="container mt-5">
 <div class="d-flex justify-content-center">
   <div class="btn-group btn-group-lg" role="group" aria-label="Large button group">
     <a type="button" class="btn btn-outline-primary" href=
    "{{route("pages.normal.index")}}">normal</a>
   </div>
 </div>
</div>
<br>
<div class="container mt-5">
 <h1>List of Pages</h1>

 @if(session('success'))
     <div class="alert alert-success">
         {{ session('success') }}
     </div>
 @endif

 @if(count($pages) > 0)
     <ul class="list-group">
         @foreach($pages as $page)
             <li class="list-group-item">
                 <h5>{{ $page['title'] }}</h5>
                 <p>{{ $page['content'] }}</p>
                 <p><strong>Side Bar:</strong> {{ $page['side_bar'] ? 'Yes' : 'No' }}</p>
                 <a href="{{route("page.view",$page['title'])}}" class="btn btn-outline-primary">show</a>
                 <form action="{{route("page.destroy",$page['title'])}}" method="POST">
                  @csrf
                  @method("DELETE")
                 <button  type="submit" class="btn btn-danger">Delete</button>
                 </form>
                </li>
         @endforeach
     </ul>
 @else
     <p>No pages found.</p>
 @endif
</div>

@endsection