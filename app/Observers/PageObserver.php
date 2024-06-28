<?php

namespace App\Observers;

use App\Models\Page;
use App\Models\Permission;
use App\Models\RelatedPage;
use App\Services\PermissionsService;
use Illuminate\Support\Facades\Artisan;

class PageObserver
{
    /**
     * Handle the Page "created" event.
     */
    public function created(Page $page): void
    {
        $pagePermissions = [];
        foreach (PermissionsService::get() as $permissionArr) {
            $pagePermissions[] = [
                'name' => $page->route . '-' . $permissionArr['name'],
                'guard_name' => 'web',
                'type' => $permissionArr['route_type'],
                'has_params' => $permissionArr['has_param'],
                'method' => $permissionArr['controller_method'],
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ];
        }
        Permission::insert($pagePermissions);

        if (request()->create_files) {
            Artisan::call('make:adminCrud', ['name' => $page->controller]);
        }
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Page "updated" event.
     */
    public function updated(Page $page): void
    {
        //
    }

    /**
     * Handle the Page "saved" event.
     */
    public function saved(Page $page): void
    {
        $page->relatedPage()->delete();
        if (request()->has('relatedPageContainer')) {
            $relatedPage = request()->relatedPageContainer;
            foreach ($relatedPage as $item) {
                if (!empty($item['child_id'])) {
                    RelatedPage::create([
                        'child_id' => $item['child_id'],
                        'parent_id' => $page['id'],
                        'type' => $item['type'] ?? 'Route',
                        'btn_color' => $item['btn_color'] ?? 'primary',
                        'into_btn_action' => $item['into_btn_action'] ?? 0,
                    ]);
                }
            }
        }
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Page "deleted" event.
     */
    public function deleted(Page $page): void
    {
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Page "restored" event.
     */
    public function restored(Page $page): void
    {
        //
    }

    /**
     * Handle the Page "force deleted" event.
     */
    public function forceDeleted(Page $page): void
    {
        //
    }
}
