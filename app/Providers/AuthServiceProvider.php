<?php

namespace App\Providers;

use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('show-order', function ($user) {
            return $user->role === User::ADMIN_ROLE;
        });

        Gate::define('show-invoice', function ($user) {
            return $user->role === User::ADMIN_ROLE;
        });

        Gate::define('update-meta', function ($user) {
            return $user->role === User::ADMIN_ROLE;
        });

        Gate::define('update-openingHour', function ($user) {
            return $user->role === User::ADMIN_ROLE;
        });

        Gate::define('update-region', function ($user) {
            return $user->role === User::ADMIN_ROLE;
        });

        Gate::define('update-postcode', function ($user) {
            return $user->role === User::ADMIN_ROLE;
        });

        Gate::define('update-rate', function ($user) {
            return $user->role === User::ADMIN_ROLE;
        });

        Gate::define('update-order', function ($user) {
            return $user->role === User::ADMIN_ROLE;
        });

        Gate::define('show-report', function ($user) {
            return $user->role === User::ADMIN_ROLE;
        });
    }
}
