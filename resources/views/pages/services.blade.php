@extends('layouts.app')
 @section('content')
  <h1 style="text-align:center">{{$title}}</h1>
    @if(count($services) > 1)
     <ul>
     @foreach ($services as $service)
      <li class="list-group-item">{{$service}} </li>    
     @endforeach
     </ul>
     @endif
@endsection