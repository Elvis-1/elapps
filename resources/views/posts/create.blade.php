@extends('layouts.app')

@section('content')
<div class="container">
<h1>Create Posts</h1>

{!! Form::open(['action' =>'App\Http\Controllers\PostsController@store', 'method' => 'POST']) !!}
    <div class="form-group">
      {{Form::label('title', 'Title')}}
      {{Form::text('title', '',['class' => 'form-control', 'placeholder' => 'Title' ])}}
    </div>
    <div class="form-group">
      {{Form::label('body', 'Body')}}
      {{Form::textarea('body', '',['id'=>'article-ckeditor', 'class' => 'ckeditor form-control', 'name'=> 'wysiwyg-editor', 'placeholder' => 'Body Text' ])}}
    </div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
{!! Form::close() !!}
</div>
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script> --}}
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
@endsection



{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Install and Use CKEditor In Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-7 offset-3 mt-4">
                <div class="card-body">
                    <form method="post" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <textarea class="ckeditor form-control" name="wysiwyg-editor"></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>

</html> --}}
