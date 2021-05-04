@extends('layouts.app')
 @section('content')
 <p style="margin-left:5px"><a href="/posts" class="btn btn-default" role="button">Go Back </a></p>
  <h1 style="text-align:center">{{$post->title}}</h1>
  <div class="container">
      <ol class="list-group list-group-numbered">
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
       {{$post->body}}
    </div>
    <span class="badge bg-primary rounded-pill">Written on {{$post->created_at}}</span>
  </li><br><br>
 </ol>
</div>
            
@endsection