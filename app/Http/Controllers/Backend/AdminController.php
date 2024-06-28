<?php

namespace App\Http\Controllers\Backend;

use App\Http\Resources\AdminResource;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\Governorate;
use App\Models\Role;

class AdminController extends BaseController
{

    protected $model = Admin::class;
    protected $resource = AdminResource::class;

    protected $indexScopes = ['ApplyFilters'];

    /**
     * Display the specified resource.
     */

    public function store(AdminRequest $request)
    {
        return parent::storeAction($request);
    }

    public function update(AdminRequest $request, $id)
    {
        return parent::updateAction($request, $id);
    }
}

