<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("App\\Repository\\ProductRepositoryInterface", "App\\Repository\\Eloquent\\ProductRepository");
        $this->app->bind("App\\Repository\\CategoryRepositoryInterface", "App\\Repository\\Eloquent\\CategoryRepository");
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
