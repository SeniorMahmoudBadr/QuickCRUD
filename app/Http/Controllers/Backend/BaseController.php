<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

abstract class BaseController extends Controller
{
    /**
     * To dynamically call a method.
     * @param string $methodName
     * @param mixed $args
     * @return mixed
     */
    private function callMethod(string $methodName, mixed $args = null): mixed
    {
        $args = Arr::wrap($args);
        return method_exists($this, $methodName) ? $this->{$methodName}(...$args) : null;
    }

    protected function indexScopes(): array
    {
        return $this->indexScopes ?? [];
    }

    protected function showScopes(): array
    {
        return $this->showScopes ?? [];
    }

    protected function updateScopes(): array
    {
        return $this->updateScopes ?? [];
    }

    protected function destroyScopes(): array
    {
        return $this->destroyScopes ?? [];
    }

    protected function customWheres(): array
    {
        return $this->customWheres ?? [];
    }

    protected function uploadedFiles(): array
    {
        return $this->uploadedFiles ?? [];
    }

    protected function withArr(): array
    {
        return $this->withArr ?? [];
    }

    protected function withSumArr(): array
    {
        return $this->withSumArr ?? [];
    }

    protected function orderByArr(): array
    {
        return $this->orderByArr ?? [];
    }

    protected function orderByRaw()
    {
        return $this->orderByRaw ?? null;
    }

    protected function withCountArr(): array
    {
        return $this->withCountArr ?? [];
    }

    protected function showWithArr(): array
    {
        return $this->showWithArr ?? [];
    }

    protected function showWithCountArr(): array
    {
        return $this->showWithCountArr ?? [];
    }

    protected function statusArr(): array
    {
        return isset($this->statusArr) ? array_merge($this->statusArr, ["approved", "suspended"]) : ["approved", "suspended"];
    }

    protected function defaultRow(): string
    {
        return $this->defaultRow ?? "id";
    }

    protected function destroyActionsArr(): array
    {
        return $this->destroyActionsArr ?? [];
    }

    protected function getModel()
    {
        return new $this->model;
    }

    protected function getModelClass()
    {
        return $this->model;
    }

    protected function selectFunction($function, $data)
    {
        try {
            $datum = $data->{$function}();
            return $datum;
        } catch (\Exception $e) {
            return [];
        }
    }

    protected function newSelectFunction($function, $data)
    {
        try {
            $datum = $data->{$function}();
            if ($datum) {
                return $datum;
            } else {
                return 0;
            }
        } catch (\Exception $e) {
            return 0;
        }
    }

    protected function getFolderName()
    {
        $folderName = substr(strrchr($this->getModelClass(), '\\'), 1);

        if (!empty($this->uploadDirectoryValue))
            $folderName .= '/' . \request()[$this->uploadDirectoryValue];

        return $folderName;
    }

    protected function getResource()
    {
        return $this->resource ?? '';
    }

    protected function getShowResource()
    {
        return $this->showResource ?? '';
    }

    public function index()
    {
        if (!request()->ajax()) {
            $currentPage = getCachedPages()->where('route', request()->segment(2))->first();
            $data = $this->callMethod("dataForIndexView");

            return view('backend.' . $currentPage->blade)
                ->with('currentPage', $currentPage)
                ->with('datatableColumnNames', $this->getModelClass()::datatableColumnNames())
                ->with($data);
        }

        $newSelects = $this->newSelectFunction("moduleNewSelects", $this);

        if ($newSelects) {
            return $newSelects;
        }

        $selects = $this->selectFunction("moduleSelects", $this);

        if (!empty($selects) && is_array($selects)) {
            return $selects;
        }

        $data = $this->getModelClass()::with($this->withArr())->withCount($this->withCountArr());
        foreach ($this->indexScopes() as $key => $value) {
            $data = $data->{$value}();
        }

        $resource = $this->getResource();

        // Handler Ordering DataTale
        $data = $data->when($this->orderByArr(), function ($query) {
            foreach ($this->orderByArr() as $key => $value) {
                $query->orderBy($key, $value);
            }
        })
            ->latest('id');

        return DataTables::eloquent($data)
            // Handler Button Action in DataTable
            ->setTransformer(function ($item) use ($resource) {
                return $resource::make($item)->resolve();
            })
            ->toJson();
    }

    protected function storeAction($request)
    {
        try {
            $this->callMethod("beforeStoreSave");
            $folderName = $this->getFolderName();
            $data = storeFilesAndReturnRequestData($this->uploadedFiles(), $request, $folderName);

            // Wrapping in a DB::transaction in order to be rolled back in case any failure in an observer or an eloquent event.
            $storedObject = DB::transaction(function () use ($data) {
                return $this->getModelClass()::create($data);
            });

            return sendResponseSuccess('Data Stored Successfully!', $storedObject);
        } catch (\Exception $e) {
            Log::error($e);
            return sendResponseFailed('Invalid error: ' . $e->getMessage(), ['message' => $e->getMessage(), 'line' => $e->getLine(),'file'=>$e->getFile()]);
        }
    }

    public function show($id)
    {
        $entity = $this->getModelClass()::with($this->showWithArr())->withCount($this->showWithCountArr())->where($this->defaultRow(), $id);
        foreach ($this->showScopes() as $key => $value) {
            $entity = $entity->{$value}();
        }

        $entity = $entity->first();

        if (!empty($this->getShowResource())) {
            $resource = $this->getShowResource();
            return new $resource($entity);
        } else {
            return response()->json($entity);
        }
    }

    protected function updateAction($request, $id)
    {
        try {
            $e = $this->getModelClass()::where($this->defaultRow(), $id);

            foreach ($this->updateScopes() as $key => $value) {

                $e = $e->{$value}();
            }

            $e = $e->first();

            abort_unless($e, 404, 'The item is not found.');

            $this->callMethod("beforeUpdateSave", $e);

            $folderName = $this->getFolderName();

            $data = storeFilesAndReturnRequestData($this->uploadedFiles(), $request, $folderName);

            // Wrapping in a DB::transaction in order to be rolled back in case any failure in an observer or an eloquent event.
            DB::transaction(function () use ($e, $data) {
                return $e->update($data);
            });

            return sendResponseSuccess('Successfully Data Updated', $e);
        } catch (\Exception $e) {
            Log::error($e);
            return sendResponseError('Invalid error: ' . $e->getMessage(), 'Line: ' . $e->getLine());
        }
    }

    public function status($id, Request $request)
    {
        $e = $this->getModelClass()::where($this->defaultRow(), $id);

        $e = $e->first();

        if (!$e) return sendResponseError([trans('The item is not found.')]);

        if ($request->status == "suspend") {

            $suspend['active'] = false;
        } elseif ($request->status == "approve") {

            $suspend['active'] = true;
        } else {
            if (!$e) {
                $e = $id;
            }

            if (in_array($request->status, $this->statusArr())) {
                $suspend['active'] = $request->status == "approve";
                $this->callMethod("afterCustomStatusDestroy", $e);
            } else if (in_array($request->status, $this->destroyActionsArr())) {

                $this->callMethod("destroyFunctionAction", $e);
                return;
            } else {
                abort(404);
            }
        }

        $e->fill($suspend);

        // Wrapping in a DB::transaction in order to be rolled back in case any failure in an observer or an eloquent event.
        DB::transaction(function () use ($e) {
            $e->save();
        });
    }

    public function statusBulk(Request $request)
    {
        /** Start Bulk Actions **/
        if ($request->status == "approve_rows") {
            if (isset($request->values) && is_array($request->values) && count($request->values) > 0) {
                $this->getModelClass()::whereIn($this->defaultRow(), $request->values)->update(['active' => true]);

                return sendResponseSuccess("Approved", []);
            } else {
                return sendResponseError([trans('app.Invalid data')]);
            }
        } elseif ($request->status == "suspend_rows") {
            if (isset($request->values) && is_array($request->values) && count($request->values) > 0) {
                $this->getModelClass()::when($this->model === 'App\Models\Admin', function ($query) {
                    $query->where('id', '<>', 1);
                })->whereIn($this->defaultRow(), $request->values)->update(['active' => false]);
                return sendResponseSuccess("Approved", []);
            } else {
                return sendResponseError([trans('app.Invalid data')]);
            }
        }
        /** End Bulk Actions **/
    }

    public function destroy($id, Request $request)
    {
        $e = $this->getModelClass()::where($this->defaultRow(), $id);
        foreach ($this->destroyScopes() as $key => $value) {
            $e = $e->{$value}();
        }
        $e = $e->first();

        if (!$e)
            return sendResponseError([trans('The item is not found.')]);

        if ($request->status == "delete") {
            $getDataAfterDelete = clone $e;

            // Wrapping in a DB::transaction in order to be rolled back in case any failure in an observer or an eloquent event.
            DB::transaction(function () use ($e) {
                $e->delete();
            });

            $this->callMethod("afterDeleteSave", $getDataAfterDelete);
        }
    }

    public function destroyBulk(Request $request)
    {
        /** Start Bulk Actions **/
        if ($request->status == "delete_rows") {
            if (isset($request->values) && is_array($request->values) && count($request->values) > 0) {
                $this->getModelClass()::when($this->model === 'App\Models\User', function ($query) {
                    $query->where('id', '<>', 1);
                })->whereIn($this->defaultRow(), $request->values)->delete();
                return sendResponseSuccess("Success Deleted", []);
            } else {
                return sendResponseError([trans('app.Invalid data')]);
            }

        }
        /** End Bulk Actions **/
    }
}
