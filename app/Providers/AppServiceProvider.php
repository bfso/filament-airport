<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        setlocale(LC_TIME, 'de_DE.utf8');

        //Filament::registerStyles([
        //    asset('css/app.css'),
        //]);

        Filament::serving(function() {
            Filament::registerNavigationGroups([
                'Scheduler',
            ]);
        });
    }
}
