<?php

namespace App\Providers;

use Laravel\Passport\Passport;
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
        // Passport::routes();
        // Gate::resource('posts', 'App\Policies\PostPolicy'); 
        // Gate::define('posts.tag', 'App\Policies\PostPolicy@tag'); 
        // Gate::define('posts.category', 'App\Policies\PostPolicy@category');    
        Passport::routes();
        // Passport::personalAccessClientId(1);
		Gate::resource('posts', 'App\Policies\PostPolicy'); 
        Gate::define('posts.tag', 'App\Policies\PostPolicy@tag'); 
        Gate::define('posts.category', 'App\Policies\PostPolicy@category'); 
    
    }

}
