<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\PermissionRequest;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;

class PermissionController extends BaseController
{
    protected $model = Permission::class;
    protected $resource = PermissionResource::class;
    protected $indexScopes = ['index'];

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        return parent::storeAction($request);
    }

    public function update(PermissionRequest $request, string $id)
    {
        return parent::updateAction($request, $id);
    }
}
