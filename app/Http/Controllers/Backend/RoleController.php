<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Page;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class RoleController extends BaseController
{
    protected $model = Role::class;
    protected $resource = RoleResource::class;

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function dataForIndexView(): array
    {
        return ['pages' => getCachedPages()];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        return parent::storeAction($request);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $role = Role::find($id);
        $role->permission = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get()
            ->toArray();

        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        return parent::updateAction($request, $id);
    }

    public function destroy($id, Request $request)
    {
        $e = $this->model::where($this->defaultRow(), $id);

        $e = $e->first();

        if (!$e)
            return sendResponseError([trans('The item is not found.')]);

        if ($request->status == "delete") {
            $getDataAfterDelete = clone $e;

            // Wrapping in a DB::transaction in order to be rolled back in case any failure in an observer or an eloquent event.
            DB::transaction(function () use ($e, $id) {
                $e->delete();
                Page::where('role_id', $id)->delete();
            });

        }
    }

    public function destroyBulk(Request $request)
    {
        /** Start Bulk Actions **/
        if ($request->status == "delete_rows") {
            if (isset($request->values) && is_array($request->values) && count($request->values) > 0) {
                $this->model::whereIn('id', $request->values)->delete();

                foreach($request->values as $value){
                    Page::where('role_id', $value)->delete();
                }

                return sendResponseSuccess("Success Deleted", []);
            } else {
                return sendResponseError([trans('app.Invalid data')]);
            }

        }
        /** End Bulk Actions **/
    }
}
