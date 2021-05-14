<?php
<?php
/* config
   C:\xampp\apache\conf\extra -- locate vhosts.conf and edit how it will serve your project
   mke correcstions as follows
   <VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs"
    ServerName localhost
</VirtualHost>
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/projectname/public"
    ServerName projectname.me
</VirtualHost>

then go to hosts in   C:\xampp\apache\conf\extra    and edit, opening notepad as an administrator
127.0.0.1    localhost
127.0.0.1    project.me

*\
/* adding bootstrap to laravel 8, do the following on cmd or bash
 |--- composer require laravel/ui
 |--- php artisan ui bootstrap or php artisan ui bootstrap --auth
 |--- npm install
 |--- npm run dev
 *\

 /* To make a controller called PostController
 |-- $ php artisan make:Controller PostController -- without resource
 |-- $ php artisan make:controller PostController --resource -- with resource

 /* To make a model called Post with migration for db
 |-- $ php artisan make:model Post -m
 |-- To use migrations,go to your env file and edit the db details
 |-- To run migration do  "php artisan migrate"
 |-- To avoid issues during migrations, add "use Illuminate\Support\Facades\Schema;" and " Schema::defaultStringLength(191);" in AppServiceProviders found in providers*\


  /*Communicate with your db from terminal using tinker
 |-- To use, run "php artisan tinker"
 |-- To check number of Post "Name of the file containing class should be the same as the class name. And the path to the file is the same as the namespace path."
 for our case run "App\Models\Post::count()"
 |-- To instantiate a post run " $post = new App\Models\Post()"
 |-- To insert run "$post->title = "Post one";
 |-- To save run " $post->save();"
 |-- To quit tinker run "quit"
 |-- To check all the route run "php artisan route:list"
*\

/*Using Route (user in web.app)
 | 
  // Route::get('/hello', function () {
  //     //return view('welcome');
  //     return 'hello';
  // });

  // Route::get('/about', function () {
  //     return view('pages.about');
    
 // });

 // Route::get('/user/{id}', function ($id) {// inserting a dynamic values
 //     return 'This is user' . $id;
    
 // });

 // Route::get('/user/{id}/{name}', function ($id,$name) {// inserting more than one dynamic values
 //     return 'This is user ' .$name . ',with an id of '. $id;
    
 // });
  // Route::get('/','PagesController@index');// it did not work
  Route::get('/','App\Http\Controllers\PagesController@index');// controller and the method that we want
  Route::get('/about','App\Http\Controllers\PagesController@about');
  Route::get('/services','App\Http\Controllers\PagesController@services');

  Route::resource('posts', 'PostController');// accessing all the resource in PostController, instead of accessing it one after the other as above;

  'use App\Models\Post'; // do this to use the Post model in the PostController
  
   // To use forms go to laravel collectives docs
   //To use editor run composer require unisharp/laravel-ckeditor


  /* php artisan clear-compiled
     composer dump-autoload
     Clear Cache: php artisan cache:clear
     Clear Route Cache:php artisan route:cache
     Clear View Cache:php artisan view:clear
    Clear Config Cache:php artisan config:cache
   *\

/* To use auth in laravel 8
| run  'composer require laravel/ui' -- you may not need this step again as it have been done before  | when you use bootsrap
| run 'php artisan ui vue --auth' or 'php artisan ui bootstrap --auth
| run 'npm install'
| run 'npm run dev'

*\

/*NPM command to remove cache
npm cache clean --force


/*Composer commands
What’s the difference between composer dump-autoload, composer update and composer install?
The above text already explains the difference between those commands, but for fast readers:

composer install installs the vendor packages according to composer.lock (or creates composer.lock if not present),
composer update always regenerates composer.lock and installs the lastest versions of available packages based on composer.json
composer dump-autoload won’t download a thing. It just regenerates the list of all classes that need to be included in the project (autoload_classmap.php). Ideal for when you have a new class inside your project.
Ideally, you execute composer dump-autoload -o , for a faster load of your webpages. The only reason it is not default, is because it takes a bit longer to generate (but is only slightly noticable)





///////////////////////////////
/////////////////////////////
/* Creating a blog website with auth
1) Environment set up
| config
   C:\xampp\apache\conf\extra -- locate vhosts.conf and edit how it will serve your project
   mke correcstions as follows
   <VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs"
    ServerName localhost
   </VirtualHost>
   <VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/projectname/public"
    ServerName projectname.me
    </VirtualHost>

   then go to hosts in   C:\Windows\System32\drivers\etc    and edit, opening notepad as an administrator
   127.0.0.1    localhost
   127.0.0.1    projectname.me 
   Restart xampp server

2) Make Pages controller
 | $ php artisan make:Controller PagesController
    go to PagesController and create methods, index, about and services and return results to index, about, and services in pages folder eg:
     public function about(){
        return view('pages.about');
    }
  create pages folder and create index, about and services file in it.

  Then go to web.php in routes folder and route the files as follows
    Route::get('/','App\Http\Controllers\PagesController@index') 
    Route::get('/about','App\Http\Controllers\PagesController@about')
    Route::get('/services','App\Http\Controllers\PagesController@services')
 go to .env and change app name then add it to your index title as follows
  <title>{{config('app.name', 'elapp')}}</title>

3) | Create template and compile assets
  create layouts folder in your views folder, and create app.blade.php file. Since the three files(index, about and services) have a similar template, put this template in the app.blade.php file and extend it to all the file its needed. To be able to add the content of the file to the template do as follows in the template
   <!DOCTYPE html>
     <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
       <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name', 'elapp')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
       
      </head>
     <body class="antialiased">
       @yield('content')
     </body>
     </html>

  Then extend app.blade.blade to all the files as follows, adding it to the index.blade.php 
    @extends('layouts.app')
     @section('content')
      <h1>This is index page</h1>
    @endsection
    
4) Send values from post controller to pages in view i.e
   public function index(){
        $title = 'Elvis first laravel app';
        return view('pages.index', compact('title')); or
        return view('pages.index')->with('title', $title);
        
    }
    display it in the index  as
       @extends('layouts.app')
         @section('content')
          <h1>{{$title}}</h1>
          <p>This is index page</p>

       @endsection

 you can also pass multiple values through the controller as this, 
  
     public function services(){
        
        $data = array(
            'title' => 'Services Page',
            'services' => ['Web Design', 'programming','SEO']
        );
        return view('pages.services')->with($data);
     }
     display it in the services page as
      @extends('layouts.app')
            @section('content')
             <h1>{{$title}}</h1>
          @if(count($services) > 1)
           <ul>
          @foreach ($services as $service)
           <li>{{$service}} </li>    
         @endforeach
          </ul>
         @endif
     @endsection

5) add bootstrap to the project, since we shall be doing auth, we will add bootstrap auth instead of just bootstrap
 /* adding bootstrap to laravel 8, do the following on cmd or bash
 |--- composer require laravel/ui
 |--- php artisan ui bootstrap or php artisan ui bootstrap --auth
 |--- npm install
 |--- npm run dev
 *\

6) Create a navbar and add your links
7) create a database in phpmyadmin for post, just the name, don't create tables
8) create a posts controller - $ php artisan make:Controller PostsController --resource
9)create model - $ php artisan make:Model Posts -m (adding -m will make laravel create a migration where you can edit your table) so when you run php artisan migrate, it will run the function in this migration.
10) add table columns to the migration like this
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');// added
            $table->mediumText('body');// added
            $table->timestamps();
        });
    }
  Migrations is found in a database folder
11) run php artisan migrate

12) add values to db columns with terminal
    run $ php artisan tinker
    access your model as follows
    App\Models\Posts::count() -- to count number of posts added already
    instantiate an object
    $post = new App\Models\Posts();
    now insert values into column
    $post->title='Post one';
    $post->body = 'This is post one';
    save post
    $post->save();
13)check all the list of methods available in your route -- php artisan route:list
14) route all the methods in PostsController -- Route::resource('posts','App\Http\Controllers\PostsController'); -- put this in web.php
15) Edit the PostsController model if you like. As follows:
    class Posts extends Model
  {
    use HasFactory;
    // table name
    protected $table = 'posts';
    //timestamp
    public $timestamp = true;
  }
16) Return values from PostsController to index file in posts folder as 
     public function index()
    {
        return view('posts.index');
    }
    create posts folder and index file
17) Add the model to PostsController as
   use  App\Models\Posts;
18) get all the post and return them through the index method (still in the PostsController
     public function index()
    {   
        Posts::all();
        return view('posts.index');
    } 
19) loop through all the posts in index file in posts folder
20) add the link to the nav
21) add a link to the title in index file to send id to the show method in 
   as  <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
22) Get the details with the id using the Posts::find($id) in the show method in the  PostSController, find() returns only one value
23)  order all the posts by created_at
      public function index()
    {   
        // $posts = Posts::all();
        $posts = Posts::orderBy('created_at', 'desc')->get();
        return view('posts.index')->with('posts',$posts);
    }
24)  You can also get your posts by a particular title
      return Post::where('title', 'Post two')->get(); or set a limit $posts = Posts::orderBy('created_at', 'desc')->take(1)->get();
25) Paginate the posts as follows
      $posts = Posts::orderBy('created_at', 'desc')->paginate(1);
      Then add  {{$posts->links()}} to the index page

26) create form and save date
     To use laravel form template do the following (You can also create form using normal html)
      a) $ composer require laravelcollective/html
      b) add this to the providers in app.php file -- Collective\Html\HtmlServiceProvider::class,
      c) add to alliances in thesame app.php file -- 'Form' => Collective\Html\FormFacde::class,
        'Html' => Collective\Html\HtmlFacde::class,
      d) your form submits to store method as -- {!! Form::open(['action' =>'App\Http\Controllers\PostsController@store', 'method' => 'POST']) !!}
27) validate the request and save the post received
     public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

      // Create Post -- we did this with tinker before
      $post = new Post;
      $post->title = $request->input('title');
      $post->body = $request->input('body');
      $post->save();

      return redirect('/posts')->with('success', 'Post created');
    }
  28) create messages.blade.php file and include it in the main layout
        @if(count($errors) > 0)
    @foreach ($errors->all() as $error )
    <div class="alert alert-danger">
       {{$error}}
    </div>
  @endforeach
     @endif

    @if(session('success'))
    <div class="alert alert-success">
      {{session('success')}}
    </div>
         @endif

        @if(session('error'))
       <div class="alert alert-danger">
      {{session('error')}}
    </div>
     @endif
29) create edit file
    a) add a link to the show file to send the id of the post to be edited
    b) collect the post id with the edit method in post controller
    c) set action to update on the edit file as (['action' =>['App\Http\Controllers\PostController@update',$post->id]
    go to the update method in the PostsController and update the post as follows

      public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

      // find the post
      $post =  Posts::find($id);
      $post->title = $request->input('title');
      $post->body = $request->input('body');
      $post->save();

      return redirect('/posts')->with('success', 'Post Updated');
    }

30) Delete post
    a) add a delete form to the show.blade.php file
    b) set action to destroy
31) add a ckeditor
    a) download a ckeditor package 
    b) create a folder called ckeditor in the public folder and add all the packages
    c) add the following content to the page where you need the editor
        {{Form::textarea('body', '',['id'=>'article-ckeditor', 'class' => 'ckeditor form-control', 'name'=> 'wysiwyg-editor', 'placeholder' => 'Body Text' ])}}

        <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
   <script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
   </script>


32) Add user id to posts column in db
    a) run $ php artisan make:migration add_user_id_to_posts(where posts is the table name) 
    b) edit the migration created as follows
        public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('user_id');
        });
    }

     /**
     * Reverse the migrations.
     *
     * @return void
     
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }

    run php artisan migrate to create the column
    run php artisan migrate rollBack
33) store the id of the logged in user into the user_id
        public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

      // Create Post -- we did this with tinker before
      $post = new Posts;
      $post->title = $request->input('title');
      $post->body = $request->input('body');
      $post->user_id = auth()->user()->id; // saving the id
      $post->save();

      return redirect('/posts')->with('success', 'Post created');
    } 
34)add dashboard link to your navbar
35) Make active users see only their posts
   a) create a method in the Posts model
     class Posts extends Model
  {
    use HasFactory;
    // table name
    protected $table = 'posts';
    //timestamp
    public $timestamp = true;

    public function user(){
        return $this->belongsTo('App\User'); // just added
    }
  } 
  b) create a method in the User model

  c) return user's post from the homecontroller
    do not forget to bring in the user model into the homecontroller -- use App\Models\User;
   public function index()
    {   
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('home')->with('posts', $user->posts);
    }
  d) display the posts in the home.blade.php page
  e) add a delete button
  f) add the name of the particular user to index page as <small>{{$post->created_at}} by {{$post->user->name}}</small> -- this is made possible due to the model relationship above
  g) also add the name to the show page 
    
36) Access Controll
   a) guest should not be able to access create without loggin in
      add this contructor to the PostController --  
       /**
     * Create a new controller instance.
     *
     * @return void
     
    public function __construct()
    {
        $this->middleware('auth');
    } 

    we noticed we could not access any page except we log in, so we add exceptions
       public function __construct()
    {
        $this->middleware('auth',['except'=> ['index','show']]);
    }
  

   set that only users that are not guest should be able to delete on the show page
        @if(!Auth::guest())
       <p style="margin-left:5px"><a href="/posts/{{$post->id}}/edit" class="btn btn-default" role="button">Edit </a></p>
      {!!Form::open(['action'=>['App\Http\Controllers\PostsController@destroy', $post->id], 'method'=>'POST','class'=>'pull-right'])!!}
     {{Form::hidden('_method','DELETE') }}
     {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
      {!!Form::close()!!} 
     @endif 

     b) retrict users deleting the posts of other users
          @if(!Auth::guest())
      @if(Auth::user->id == $post->id)
      <p style="margin-left:5px"><a href="/posts/{{$post->id}}/edit" class="btn btn-default" role="button">Edit </a></p>
      {!!Form::open(['action'=>['App\Http\Controllers\PostsController@destroy', $post->id], 'method'=>'POST','class'=>'pull-right'])!!}
      {{Form::hidden('_method','DELETE') }}
      {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
     {!!Form::close()!!}  
     </ol>
     @endif
     @endif
    C) restrict users from being able to pass the url to edit or delete the post of others
       add this to the edit method in postcontroller
            public function edit($id)
       {
         $post = Posts::find($id);

         // check for user
          if(auth()->users()->id !== $posts->user_id){    // added
            return redirect('/posts')->with('error','Unauthorized page');
          }
         return view('posts.edit')->with('post',$post);
        }
       
        add this to the destroy method in postcontroller
             public function destroy($id)
      {
        $post = Posts::find($id);
         // check for user
         if(auth()->users()->id !== $post->user_id){  // added
            return redirect('/posts')->with('error','Unauthorized page');
          }
        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');
     }

37) Adding file upload
    a) add to the form in <create class="blade php"
          <div class="form-group">
        {{Form::file('cover_image')}}
     </div>
    b) add image column to the posts table, to do this do:
        $ php artisan make:migration add_cover_image_to_posts
    c) open the migration and add the necessary column as follows:
           public function up()
        {
       
            Schema::table('posts', function (Blueprint $table) {
                $table->string('cover_image');
            });
        
        }   
   d) run $ php artisan migrate
   e) since our store method receives posts, add the following to it
               public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

      // Handle file upload
      if($request->hasFile('cover_image')){
          // get file name with ext
         $fileNameWithExt = $request->file('cover_image')->getClientOriganalName();
          // get just file name
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
          // get just ext
        $extention = $request->file('cover_image')->getClientOriginalExtension();
        // file name to store
        $fileNameToStore = $fileName .'_'. time() .'.' . $extention;
        // Upload image
        $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
      }else{
          $fileNameToStore = 'noimage.jpg';
      }   

      // Create Post -- we did this with tinker before
      $post = new Posts;
      $post->title = $request->input('title');
      $post->body = $request->input('body');
      $post->user_id = auth()->users()->id;
       $post->cover_image = $fileNameToStore;
      $post->save();

      return redirect('/posts')->with('success', 'Post created');
    }
  f) public folder is located in storage and storage is not accessible by the browser, so go  around it by the following
      $ php artisan storage:link
  g) add the file path to the pages where you want to display it
      <img src="/storage/cover_images/{{$post->cover_image}}" style="width:100%">
  h) Delete image. To delete image, do the following
      add use Illuminate\Support\Facades\Storage; to postcontroller
      add to destroy method 
           if($post->cover_image != 'noimage.jpg'){
              // delete image
              Storage::delete('public/cover_images/'.$post->cover_image);
          }
       
   
























