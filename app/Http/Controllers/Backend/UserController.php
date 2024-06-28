<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\AppUser;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends BaseController
{
    protected $model = AppUser::class;
    protected $resource = UserResource::class;

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        return parent::storeAction($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = AppUser::find($id);
        $uRoles = AppUser::find($id);
        $user->roles = $uRoles->roles->pluck('name')->all();
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        return parent::updateAction($request, $id);
    }

    public function getUsers($id) {
        return sendResponseSuccess('Success',User::where('center_id','like', "%".$id."%")->whereHas('role', fn($q) => $q->where('name','Case Worker'))->where('status','approved')->get());
    }
}
