<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $posts = $category->posts;

        return view('posts.index', compact('posts'));
    }
}
