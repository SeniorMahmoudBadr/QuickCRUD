<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    protected $model = Category::class;
    protected $resource = CategoryResource::class;
    // protected $indexScopes=[];
    // protected $showScopes=[];
    // protected $updateScopes=[];
    // protected $destroyScopes=[];

    public function store(CategoryRequest $request)
    {
        return parent::storeAction($request);
    }

    public function update(CategoryRequest $request, $id)
    {
        return parent::updateAction($request, $id);
    }
}

