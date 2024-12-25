<?php

namespace App\Providers;

use App\Models\User;
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
        Gate::define('SA', function(User $user){
            return $user->role === 'SA';
        });
        
        Gate::define('CA-ONLY', function(User $user){
            return $user->role === 'CA';
        });
    }
}
