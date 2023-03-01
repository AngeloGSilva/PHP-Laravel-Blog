<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{

    public function create()
    {
        // if(auth()->guest()){
        //     abort(Response::HTTP_FORBIDDEN);
        //     return view('posts.create');
        // }


        return view('posts.create');
    }

    public function store()
    {
        // //ddd(request()->file('thumbnail'));
        // request()->file('thumbnail')->store('thumbnails');
        // //ddd($re);
        // return 'done';
        //ddd(request());
        $attributes = request()->validate([
            'title' => 'required',
            'thumbnail' => 'required|image',
            'slug' => ['required', Rule::unique('posts','slug')],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories','id')]
        ]);

        $attributes['thumbnail'] = request('thumbnail')->store('thumbnails');
        $attributes['user_id'] = auth()->id();


        //ddd($attributes);

        $post = Post::create($attributes);
        //dd($post->get());
        return view('posts.show', [
            'post' => $post,
        ]);

    }



    public function index()
    {
        //Gate::allows('admin');
        //request()->user()->can('admin');
        return view('posts.index', [
            'posts' => Post::latest()
                ->filter(request(['search', 'category', 'author']))
                ->paginate(9)
                ->withQueryString(),
        ]);
    }
    //withQueryString() para fazer com a pesquisa
    //tb pode ser ->simplePaginate(3); bom para dataSets mt grandes pois nao calcula quantos sao

    public function show(Post $post)
    {
        // $response =Http::get('https://lerolero.com/');
        // dd($response);

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    // protected function getPosts(){
    //     return $posts = Post::latest()->filter()->get();
    //     // if(request('search')){
    //     //     $posts->where('title','like','%' . request('search').'%')
    //     //     ->orwhere('body','like','%' . request('search').'%');
    //     // }

    // }
}
