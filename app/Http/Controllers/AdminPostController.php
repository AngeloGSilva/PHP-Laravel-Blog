<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class AdminPostController extends Controller
{
    public function index(){
        return view('admin.posts.index',[
            'posts' => Post::paginate(50)
        ]);
    }


    public function edit(Post $post){
        return view('admin.posts.edit',['post' => $post]);
    }

    public function update(Post $post){

        $attributes = request()->validate([
        'title' => 'required',
        'thumbnail' => 'image',
        'slug' => ['required', Rule::unique('posts','slug')->ignore($post->id)],
        'excerpt' => 'required',
        'body' => 'required',
        'category_id' => ['required', Rule::exists('categories','id')]
        ]);

        if(isset($attributes['thumbnail'])){
            $attributes['thumbnail'] = request('thumbnail')->store('thumbnails');
        }
        //$attributes['user_id'] = auth()->id();


        //ddd($attributes);

        //$post = Post::create($attributes);

        $post->update($attributes);
    return back()->with('success','Post Updated!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success','Post Delete!');
    }

}
