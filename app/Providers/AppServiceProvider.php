<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['components.sidebar'], function ($view) {
            if(!Cache::has("menu_sidebar")){
                Cache::forever("menu_sidebar", Menu::getAll());
            }
            $view->with('menu_sidebar', Menu::getAll());
        });
        Paginator::useBootstrap();
    }

    
}
