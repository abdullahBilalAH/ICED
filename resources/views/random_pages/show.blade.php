@extends("random_pages.app")
@section("title")
{{$page["title"]}}
@endsection

@section("content")
<div class="container mt-5">
 <div class="company-header text-center mb-4">
     <h1 class="display-4">{{ $page['title'] }}</h1>
     <p class="lead">Innovating the Future of Technology</p>
 </div>
 <div class="company-info">
     {!! $page['content'] !!}
 </div>
</div>@endsection