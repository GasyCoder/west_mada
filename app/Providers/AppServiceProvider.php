<?php

namespace App\Providers;

use View;
use App\Models\Page;
use App\Models\Navbar;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->singleton(ErrorsManager::class, function () {
        //     return new ErrorsManager();
        // });

        // $this->app->singleton(EventDispatcher::class, function () {
        //     return new EventDispatcher();
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void    
    {
        View::composer('*', function ($view) {

            $navbars = Navbar::orderBy('id', 'asc')->where('is_active', true)->get();

            // Filtrer les onglets inactifs
            foreach ($navbars as $navbar) {
                $navbar->onglets = $navbar->onglets->where('is_active', true)->where('is_slider', false);
            }

            $view->with('navbars', $navbars);
        });
    }

}
