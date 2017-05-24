<?php

namespace App\Providers;

use App\Entities\Game;
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
        view()->composer('layouts.filters', function ($view) {
            $view->with('games',
                Game::all()
            );
        });

        view()->composer('layouts.posts.checkboxes', function ($view) {
            $view->with('games',
                Game::all()
            );
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RepositoryServiceProvider::class);
    }
}
