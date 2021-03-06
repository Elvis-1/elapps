@extends('layouts.app')
 @section('content')
 <p style="margin-left:5px"><a href="/posts" class="btn btn-default" role="button">Go Back </a></p>
  <h1 style="text-align:center">{{$post->title}}</h1>
              <div style="width:300px"><img src="/storage/cover_images/{{$post->cover_image}}" style="width:100%"></div><br><br>
  <div class="container">
      <ol class="list-group list-group-numbered">
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
       {{$post->body}}
    </div>
    <small class="badge bg-primary rounded-pill">Written on {{$post->created_at}}  by {{$post->user->name}}</small>

  </li><br><br>
  @if(!Auth::guest())
      @if(Auth::user()->id == $post->user_id)
  <p style="margin-left:5px"><a href="/posts/{{$post->id}}/edit" class="btn btn-default" role="button">Edit </a></p>
  {!!Form::open(['action'=>['App\Http\Controllers\PostsController@destroy', $post->id], 'method'=>'POST','class'=>'pull-right'])!!}
   {{Form::hidden('_method','DELETE') }}
   {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
   {!!Form::close()!!}  
 </ol>
 @endif
 @endif
</div>
            
@endsection