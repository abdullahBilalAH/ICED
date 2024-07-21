@extends("layouts.pages")

@section("title")
create normal pages
@endsection

@section("content")
<form action="{{route('pages.store')}}" method="POST">
 @csrf

 <div class="input-group input-group-lg mb-3">
   <span class="input-group-text" id="inputGroup-sizing-lg">Title</span>
   <input type="text" name="title" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
 </div>
 <div class="form-floating mb-3">
   <textarea class="form-control" name="content" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px">Content</textarea>
 </div>
 <div class="form-check mb-3">
   <input class="form-check-input" name="side_bar" type="checkbox" value="" id="flexCheckChecked" checked>
   <label class="form-check-label" for="flexCheckChecked">
     Side Bar
   </label>
 </div>
 <button type="submit" class="btn btn-primary">Make New Page</button>
</form>

@endsection