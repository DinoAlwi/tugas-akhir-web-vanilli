<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Carbon;

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
    public function boot()
    {
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');

        Gate::define('admin', function (User $user) {
            return $user->roles[0]->role === 'Admin';
        });

        Gate::define('petani', function (User $user) {
            return $user->roles[0]->role === 'Petani';
        });

        Gate::define('pembeli', function (User $user) {
            return $user->roles[0]->role === 'Pembeli';
        });
    }
}
