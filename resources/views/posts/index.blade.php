@extends('layouts.app')
 @section('content')
  <h1 style="text-align:center">Posts</h1>
  @if(count($posts) > 0)
    @foreach ($posts as $post )
     <div class="container">
      <ol class="list-group list-group-numbered">
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
       <div class="row">
          <div class="col-md-4 col-sm-8">
            <img src="/storage/cover_images/{{$post->cover_image}}" style="width:100%">
          </div>

          <div class="col-md-8 col-sm-8" >
          <div class="fw-bold"><h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3></div>
      <small>{{$post->created_at}} by {{$post->user->name}}</small>
    </div>
    <span class="badge bg-primary rounded-pill">{{$post->user_id}}</span>
          </div>
       </div>
      
  </li><br><br>
 
</ol>
</div>
  @endforeach
  {{$posts->links()}}

  @else
     <p>No Post found</p>
  @endif
@endsection