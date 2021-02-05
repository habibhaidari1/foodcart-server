<?php

namespace App\Providers;

use Illuminate\Database\Schema\Builder;
use Illuminate\Foundation\AliasLoader;
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
        $loader = AliasLoader::getInstance();
        $loader->alias(
            'Srmklive\PayPal\Traits\PayPalAPI',
            'App\Traits\PayPalAPI'
        );
        $loader->alias(
            'Srmklive\PayPal\Services\PayPal',
            'App\Services\PayPal'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::defaultStringLength(200); // Update defaultStringLength
    }
}
