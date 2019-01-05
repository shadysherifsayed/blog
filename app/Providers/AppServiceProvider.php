<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        View::share('categories', \App\Category::all());

        if(auth()->guard('admin')->check()) {
            $authUser = auth()->guard('admin')->user();
        } elseif(auth()->check()) {
            $authUser = auth()->user();
        } else {
            $authUser = null;
        }
        View::share('authUser', $authUser);

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
