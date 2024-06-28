<?php

namespace App\Observers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Artisan;

class PermissionObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public bool $afterCommit = true;

    /**
     * Handle the Permission "created" event.
     */
    public function created(Permission $permission): void
    {
       //
    }

    /**
     * Handle the Permission "updated" event.
     */
    public function updated(Permission $permission): void
    {
        //
    }

    /**
     * Handle the Permission "saved" event.
     */
    public function saved(Permission $permission): void
    {
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Permission "deleted" event.
     */
    public function deleted(Permission $permission): void
    {
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Permission "restored" event.
     */
    public function restored(Permission $permission): void
    {
        //
    }

    /**
     * Handle the Permission "force deleted" event.
     */
    public function forceDeleted(Permission $permission): void
    {
        //
    }
}
