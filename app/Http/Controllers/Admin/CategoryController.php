<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $category = Category::create($request->only('name'));

        // Use those routes to append it from JS and use them
        $category->actions = route('admin.categories.update', $category);
        $category->show = route('categories.show', $category);

        return api(compact('category', 'route'));
    }


  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $category->update($request->only('name'));

        return api(['id' => $category->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        $category->delete();

        /**
         * API function is helper function I made to make
         * the response as json more easier
         */

        return api(['id' => $category->id]);

    }
}
