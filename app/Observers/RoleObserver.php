<?php

namespace App\Observers;

use App\Models\Page;
use App\Models\Role;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public bool $afterCommit = true;

    /**
     * Handle the Role "created" event.
     */
    public function created(Role $role)
    {
        $this->createPage($role);
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Role "updated" event.
     */
    public function updated(Role $role)
    {
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Role "saved" event.
     */
    public function saved(Role $role): void
    {
        $role->syncPermissions(request()->input('permission'));
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Role "deleted" event.
     */
    public function deleted(Role $role): void
    {
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Role "restored" event.
     */
    public function restored(Role $role): void
    {
        //
    }

    /**
     * Handle the Role "force deleted" event.
     */
    public function forceDeleted(Role $role): void
    {
        //
    }

    /**
     * Crete Page For The Role
     * @param Role $role
     * @return void
     */
    private function createPage(Role $role): void
    {
        $adminPage = Page::where('route', 'Admin')->first();

        if ($adminPage) {
            Page::create([
                "name_en" => $role->name,
                "name_ar" => $role->name,
                "route" => Str::of($role->name)->title()->replace(' ', ''),
                "controller" => $adminPage->controller,
                "blade" => $adminPage->blade,
                "javascript" => $adminPage->javascript,
                "parent_id" => $adminPage->parent_id,
                "position" => $adminPage->position,
                "display" => $adminPage->display,
                "role_id" => $role->id,
                "sort" => $adminPage->sort + 1,
            ]);

            // To avoid creating files by the PageObserver
            request()->merge(['create_files' => 0]);
        }
    }
}
