<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerDashboardPolicies();
        //
    }

    public function registerDashboardPolicies()
    {        
        Gate::define('dashboard-student', function ($user) {
            return $user->inRole('student');
        });

        Gate::define('dashboard-teacher', function ($user) {
            return $user->inRole('teacher');
        });
    }
}
