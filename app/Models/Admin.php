<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Admin extends User
{
    protected static function booted(): void
    {
        $roleName = Role::findById(Page::where('route', request()->segment(2))->first()->role_id)->name;
        static::addGlobalScope('byRole',function ($query){
            $query->has('role_id', Role::findByName('admin')->id);
        });
        static::saving(function ($admin) use ($roleName) {
            $admin->assignRole($roleName);
        });
    }

    public function getMorphClass(): string
    {
        return User::class;
    }
}
