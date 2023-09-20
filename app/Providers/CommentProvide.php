<?php

namespace App\Providers;

use App\Repositories\CommentRepository;
use Illuminate\Support\ServiceProvider;

class CommentProvide extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CommentRepository::class);
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
