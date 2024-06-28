<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => ['auth', 'not-suspended']], function () {
    try {
        foreach (getCachedPages() as $page) {
            $controller = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $page->controller);
            if (file_exists(app_path("Http" . DIRECTORY_SEPARATOR . "Controllers" . DIRECTORY_SEPARATOR . "Backend" . DIRECTORY_SEPARATOR . $controller . "Controller.php"))) {
                $controller_name = "App\Http\Controllers\Backend\\" . $controller . "Controller";
                Route::controller($controller_name)->prefix($page->route)->group(function () use ($page) {
                    foreach ($page->permissions->where('status','approved') as $permission) {
                        Route::{$permission->type}('/' . $permission->method . ($permission->has_params ? '/{id}' : ""), $permission->method)
                            ->middleware('can:'.$permission->name);
                    }
                });
            }
        }

    } catch (\Exception $e) {
        Log::error($e);
    }
});
