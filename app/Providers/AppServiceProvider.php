<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        if (!App::environment('testing')) {

            $categories = Category::withCount('posts')->orderBy('posts_count', 'desc')->get();
            
            View::share('categories', $categories);
        }



    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
