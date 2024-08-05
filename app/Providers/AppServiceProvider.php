<?php

namespace App\Providers;

use App\Models\User;
use Laravel\Pennant\Feature;
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
        //
        Feature::define('register-users', fn (User $user) => match (true) {
            $user->isSuperAdmin() => true
        });
    }
}
