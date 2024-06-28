<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        try {
            $databaseName = config('database.connections.mysql.database');

            $exists = DB::select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?", [$databaseName]);

            if(empty($exists)) {
//                Log::info("Database: {$databaseName} does not exist");
            } else {
//                Log::info("Database: {$databaseName} exists");
                Gate::allows(getCachedPermissions()->where('status', 'approved')->pluck('name'));

                Gate::before(function ($user, $ability) {
                    return getCachedPermissions()->where('status', 'approved')->where('name', $ability)->count() && $user->hasRole('Super Admin') ? true : null;
                });
            }
        } catch (Exception $e) {
//            Log::error("Database check failed: {$e->getMessage()}");
        }
        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()

    }
}
