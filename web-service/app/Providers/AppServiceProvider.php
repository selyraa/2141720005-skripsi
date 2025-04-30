<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Define authorization gates
        Gate::define('manage-users', function ($user) {
            // Only allow 'ahli gizi' and 'asisten ahli gizi' to manage users
            return $user->role && in_array($user->role->name, ['ahli gizi', 'asisten ahli gizi']);
        });
    }
}
