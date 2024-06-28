<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\SubCategoryRequest;
use App\Http\Resources\SubCategoryResource;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends BaseController
{
    protected $model = SubCategory::class;
    protected $resource = SubCategoryResource::class;
    // protected $indexScopes=[];
    // protected $showScopes=[];
    // protected $updateScopes=[];
    // protected $destroyScopes=[];

    public function store(SubCategoryRequest $request)
    {
        return parent::storeAction($request);
    }

    public function update(SubCategoryRequest $request, $id)
    {
        return parent::updateAction($request, $id);
    }
}

