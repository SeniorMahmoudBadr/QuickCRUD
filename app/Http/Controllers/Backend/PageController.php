<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Http\Resources\PageResource;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use DB;
use DataTables;
use Illuminate\Support\Facades\Log;


class PageController extends BaseController
{
    protected $model = Page::class;
    protected $resource = PageResource::class;
    protected $showWithArr=['relatedPage'];
    protected $withArr=['relatedPage'];

    function dataForIndexView(): array
    {
        return ['pages' => $this->model::orderBy('name_en')->get()];
    }

    public function store(PageRequest $request)
    {
        return parent::storeAction($request);
    }

    public function update(PageRequest $request, $id)
    {
        return parent::updateAction($request, $id);
    }
}
