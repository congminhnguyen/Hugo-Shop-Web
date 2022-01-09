<?php

namespace App\Providers;

use App\Http\View\Composers\CartComposer;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\CategoryComposer;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('header', CategoryComposer::class);
        View::composer('cart', CartComposer::class);
    }
}
