<?php

namespace App\Providers;

use App\Models\Listings;
use App\Models\User;
use App\Policies\ListingPolicy;
use App\Policies\UserPolicy;
use Illuminate\Auth\Access\Gate;
use \Illuminate\Foundation\Support\Providers\AuthServiceProvider;

class AppServiceProvider extends AuthServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        Listings::class => ListingPolicy::class
    ];

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
        $this->registerPolicies();
    }
}
