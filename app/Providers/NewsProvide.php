<?php

namespace App\Providers;

use App\Repositories\NewsRepository;
use Illuminate\Support\ServiceProvider;

class NewsProvide extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(NewsRepository::class);
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
