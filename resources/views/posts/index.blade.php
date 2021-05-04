@extends('layouts.app')
 @section('content')
  <h1 style="text-align:center">Posts</h1>
  @if(count($posts) > 1)
    @foreach ($posts as $post )
     <div class="container">
      <ol class="list-group list-group-numbered">
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold"><h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3></div>
      <small>{{$post->created_at}}</small>
    </div>
    <span class="badge bg-primary rounded-pill">{{$post->user_id}}</span>
  </li><br><br>
 
</ol>
</div>
  @endforeach

  @else
     <p>No Post found</p>
  @endif
@endsection