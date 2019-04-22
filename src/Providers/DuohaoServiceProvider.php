<?php
namespace Duohao\Providers;

use Illuminate\Support\ServiceProvider;

class DuohaoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'std');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->single
    }
}
