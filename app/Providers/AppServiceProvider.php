<?php

namespace App\Providers;

use App\Entities\Game;
use App\Repositories\GameRepository;
use Backpack\Settings\app\Models\Setting;
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
                app(GameRepository::class)->all()
            );
        });

        view()->composer('layouts.posts.checkboxes', function ($view) {
            $view->with('games',
                app(GameRepository::class)->all()
            );
        });

        view()->composer('layouts.footer', function ($view) {
            $view->with('email',
                app(Setting::class)->where('key', 'contact_email')->first()
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
