<?php

namespace App\Http\Controllers\Admin;

use App\Classes\TextEditor;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post;

        return view('posts.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

        $post = Post::make($request->only('title', 'description'));

        $post->content = TextEditor::create($request->content, 'images/posts');

        $post->save();

        $post->categories()->attach($request->categories);

        return redirect(route('posts.show', $post));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {

        $newCategories = collect($request->categories);

        $currentCategories = $post->categories()->select('categories.id')->get();

        // If post has categories, pluck their IDs
        if ($currentCategories->isNotEmpty()) {
            $currentCategories = $currentCategories->pluck('id');
        } else {
            $currentCategories = collect();
        }

        /**
         * @example
         * new ['2', '4', '10']
         * current ['4', '8']
         * @result
         * addedCategories ['2', '10']
         * removedCategories ['8']
         */

        $addedCategories = $newCategories->diff($currentCategories);

        $removedCategories = $currentCategories->diff($newCategories);

        $post->title = $request->title;

        $post->description = $request->description;

        $post->content = TextEditor::create($request->content, 'images/posts');

        $post->save();

        if ($addedCategories->isNotEmpty()) {
            $post->categories()->attach($addedCategories);
        }

        if ($removedCategories->isNotEmpty()) {
            $post->categories()->detach($removedCategories);
        }

        return redirect(route('posts.show', $post));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index');
    }
}
