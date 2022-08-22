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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('permission', function ($user, $checkViews) {
            $checkViews = !is_array($checkViews) ? [$checkViews] : $checkViews;
            $allow = false;
            foreach ($checkViews as $checkView){
                $permission = explode(",", $user->permission);

                if (in_array($checkView, $permission) ){
                    $allow = true;
                }
            }

            return $user->role_id == - 1 ? true : $allow;
        });
    }
}
