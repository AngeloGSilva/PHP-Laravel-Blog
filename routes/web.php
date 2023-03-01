<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SessionController;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\PostCommentsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('newsletter',function(){

    request()->validate(['email' => 'required|email']);
    $mailchimp = new \MailchimpMarketing\ApiClient();

    $mailchimp->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => 'us18'
    ]);

    $response = $mailchimp->lists->addListMember('59bd665d9d',[
        'email_address' => request('email'),
        'status' => 'subscribed'
    ]);
    return redirect('/')
        ->with('success','You are now signed up for our newsletter');
});


Route::get('/',[PostController::class, 'index']);

Route::post('posts/{post:slug}/comments',[PostCommentsController::class,'store']);

Route::get('posts/{post:slug}',[PostController::class, 'show']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login',[SessionController::class,'create'])->middleware('guest');
Route::post('sessions',[SessionController::class,'login'])->middleware('guest');

Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');
// Route::get('/', function () {


    //group para middleware nao necessario mas ajuda a limpar o codigo
Route::middleware('can:admin')->group(function() {
    Route::get('admin/posts/create',[PostController::class, 'create']);

    Route::post('admin/posts',[PostController::class, 'store']);

    Route::get('admin/posts',[AdminPostController::class, 'index']);

    Route::get('admin/posts/{post}/edit',[AdminPostController::class, 'edit']);

    Route::patch('admin/posts/{post}', [AdminPostController::class, 'update']);

    Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy']);
});


// Route::get('admin/posts/create',[PostController::class, 'create'])->middleware('admin');

// Route::post('admin/posts',[PostController::class, 'store'])->middleware('admin');

// Route::get('admin/posts',[AdminPostController::class, 'index'])->middleware('admin');

// Route::get('admin/posts/{post}/edit',[AdminPostController::class, 'edit'])->middleware('admin');

// Route::patch('admin/posts/{post}', [AdminPostController::class, 'update'])->middleware('admin');

// Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy'])->middleware('admin');
//     //$posts = Post::latest()->with('category','author')->get();
//     // $posts = Post::latest()->with('category','author');
//     // if(request('search')){
//     //     $posts->where('title','like','%' . request('search').'%')
//     //     ->orwhere('body','like','%' . request('search').'%');
//     // }

//     // return view('posts',[
//     //     'posts' => $posts->get(),
//     //     'categories' => Category::all()
//     // ]);

//     // $document = YamlFrontMatter::parseFile(
//     //     resource_path('posts/Primeiro.html')
//     // );

//     // dd($document);

//     //$files = File::files(resource_path("posts"));
//     //$posts = [];



//     //outras maneiras de fazer os msm

//     // $posts = array_map(function ($file){
//     //     $document = YamlFrontMatter::parseFile($file);
//     //     return new Post(
//     //         $document->title,
//     //         $document->excerpt,
//     //         $document->date,
//     //         $document->body(),
//     //         $document->slug
//     //     );
//     // },$files);

//     // foreach($files as $file){

//     //     $document = YamlFrontMatter::parseFile($file);

//     //     $posts[] = new Post(
//     //         $document->title,
//     //         $document->excerpt,
//     //         $document->date,
//     //         $document->body(),
//     //         $document->slug
//     //     );
//     // }

//     //dd($posts);

// });

// Route::get('posts/{post:slug}',function(Post $post){ // +/- igual a Post::where('slug',$post)->firstOrFail();
//     //find a post by its slug and pass it to a view called "post"
//     //ddd($slug);
//     //$post = Post::findOrFail($id);
//     //ddd($post);
//     return view('post',[
//         'post' => $post
//     ]);

//     //maneira junk de se fazer
//     // //return $slug;
//     // //$path = __DIR__ . "/../resources/posts/$slug";
//     // //declarar inlinne
//     // if(!file_exists($path = __DIR__ . "/../resources/posts/{$slug}" )){
//     //     //ddd('file nao existe');
//     //     //abort(404);
//     //     return redirect('/');
//     // }

//     // //guardar em cash por 20 minutos.. sem now é em segundos para poupar recursos
//     // //$post = cache()->remember("posts.{$slug}",now()->addMinutes(20),function() use ($path){
//     // //    var_dump('file_get_contents'); // para ver qunado esta funcao é usada
//     // //    return file_get_contents($path);
//     // //});
//     // //maneira mais clean
//     // $post = cache()->remember("posts.{$slug}",now()->addMinutes(20),fn() => file_get_contents($path));

//     // //$post = file_get_contents($path);

//     // return view('post',[
//     //     'post' => $post
//     // ]);
// });
// //ou assim whereAlpha('post'); so letras



// Route::get("categories/{category:slug}",function (Category $category){
//     //registar no storage/logs o que acontece
//     //\Illuminate\Support\Facades\DB::listen(function ($query){
//     //    logger($query->sql);
//     //});
//     //clockwork tem as serve para o msm que o log.... devtools no browser e tem a tab clockwork
//     return view('posts',[
//         'posts' => $category->posts->load(['category', 'author']),
//         'currentCategory' => $category,
//         'categories' => Category::all()
//     ]);
// });



// Route::get("authors/{author:username}",function (User $author){
//     //registar no storage/logs o que acontece
//     //\Illuminate\Support\Facades\DB::listen(function ($query){
//     //    logger($query->sql);
//     //});
//     //clockwork tem as serve para o msm que o log.... devtools no browser e tem a tab clockwork
//     return view('posts.index',[
//         'posts' => $author->posts->load(['category', 'author'])
//     ]);
// });
