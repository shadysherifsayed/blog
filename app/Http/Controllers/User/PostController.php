<?php

namespace App\Http\Controllers\User;

use App\Post;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        if(auth()->guard('admin')->check()) {
            $authUser = auth()->guard('admin')->user();
        } elseif(auth()->check()) {
            $authUser = auth()->user();
        } else {
            $authUser = null;
        }

        return view('posts.index', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Toggle like for specified resource
     *
     * @return \Illuminate\Http\Response
     */
    public function toggleLike(Post $post)
    {
        $post->toggleLike;

        $liked = $post->liked;
        
        $likesCount = $post->likes_count;

        return api(compact('liked', 'likesCount'));
    }

}
