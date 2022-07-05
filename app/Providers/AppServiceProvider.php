<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       // $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Begin : UUID Adjustment */
        Permission::retrieved(function (Permission $permission) {
            $permission->incrementing = false;
        });
        
        Permission::creating(function (Permission $permission) {
            $permission->incrementing = false;
            $permission->id = (string) Str::uuid();
        });

        Role::retrieved(function (Role $role) {
            $role->incrementing = false;
        });

        Role::creating(function (Role $role) {
            $role->incrementing = false;
            $role->id = (string) Str::uuid();
        });
        /* End : UUID Adjustment */

    }
}
