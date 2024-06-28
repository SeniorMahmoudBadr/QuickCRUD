<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;
use App\Observers\ChildObserver;
use App\Models\Child;

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
        // Adding status method to Blueprint class
        Blueprint::macro('status', function ($values = []) {
            $values = empty($values) ? ['approved', 'suspended'] : $values;
            $defaultStatus = in_array('approved', $values) ? 'approved' : $values[0];
            return $this->enum('status', $values)->default($defaultStatus);
        });
    }
}
