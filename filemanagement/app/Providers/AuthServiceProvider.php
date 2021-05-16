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

        $this->dashboardPermission();
        $this->filesPermission();
        $this->uploadPermission();
        $this->userPermission();
        $this->rolePermission();
    }

    public function dashboardPermission()
    {
        Gate::define('list_dashboard', function ($user) {
            return $user->checkPermissionAccess('list_dashboard');
        });

        Gate::define('download_dashboard', function ($user) {
            return $user->checkPermissionAccess('download_dashboard');
        });

        Gate::define('delete_dashboard', function ($user) {
            return $user->checkPermissionAccess('delete_dashboard');
        });
    }

    public function filesPermission()
    {
        Gate::define('list_files', function ($user) {
            return $user->checkPermissionAccess('list_files');
        });

        Gate::define('add_folder_files', function ($user) {
            return $user->checkPermissionAccess('add_folder_files');
        });

        Gate::define('download_files', function ($user) {
            return $user->checkPermissionAccess('download_files');
        });

        Gate::define('edit_files', function ($user) {
            return $user->checkPermissionAccess('edit_files');
        });

        Gate::define('delete_files', function ($user) {
            return $user->checkPermissionAccess('delete_files');
        });

    }

    public function uploadPermission()
    {
        Gate::define('upload_file_upload', function ($user) {
            return $user->checkPermissionAccess('upload_file_upload');
        });
    }

    public function userPermission()
    {
        Gate::define('list_user', function ($user) {
            return $user->checkPermissionAccess('list_user');
        });

        Gate::define('add_user', function ($user) {
            return $user->checkPermissionAccess('add_user');
        });

        Gate::define('edit_user', function ($user) {
            return $user->checkPermissionAccess('edit_user');
        });

        Gate::define('delete_user', function ($user) {
            return $user->checkPermissionAccess('delete_user');
        });
    }

    public function rolePermission()
    {
        Gate::define('list_role', function ($user) {
            return $user->checkPermissionAccess('list_role');
        });

        Gate::define('add_role', function ($user) {
            return $user->checkPermissionAccess('add_role');
        });

        Gate::define('edit_role', function ($user) {
            return $user->checkPermissionAccess('edit_role');
        });

        Gate::define('delete_role', function ($user) {
            return $user->checkPermissionAccess('delete_role');
        });
    }
}
