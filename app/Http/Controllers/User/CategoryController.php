<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Show all posts for a category
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $posts = $category->posts;

        return view('posts.index', compact('posts'));
    }
}
