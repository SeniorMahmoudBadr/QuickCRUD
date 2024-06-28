<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    public function scopeIndex($query)
    {
        return $query->when(request()->row_id, function ($query) {
            $page = Page::find(request()->row_id);

            $query->when($page, function ($query) use ($page) {
                $query->where('name', 'like', $page->route . '-%');
            });

            $query->when(request()->status_search, function ($query) {
                $query->where('status', request()->status_search);
            });
        });
    }

    public static function datatableColumnNames()
    {
        $array = [
            [
                'title' => '#',
                'data' => 'id',
                "searchable" => false,
                "orderable" => false,
                'visible' => true,
                "className" => "not-exportable"
            ],
            [
                'title' => trans('app.Name'),
                'data' => 'name',
                "searchable" => true,
                "orderable" => true,
                'visible' => true,
                "className" => ""
            ],
            [
                'title' => 'Type Method',
                'data' => 'type',
                "searchable" => true,
                "orderable" => false,
                'visible' => true,
                "className" => ""
            ],
            [
                'title' => 'Has Parameter',
                'data' => 'has_params',
                "searchable" => true,
                "orderable" => false,
                'visible' => true,
                "className" => ""
            ],
            [
                'title' => 'Method',
                'data' => 'method',
                "searchable" => false,
                "orderable" => false,
                'visible' => true,
                "className" => ""
            ],
            [
                'title' => 'Status',
                'data' => 'status',
                "searchable" => false,
                "orderable" => false,
                'visible' => true,
                "className" => ""
            ],
            [
                'title' => trans('app.Actions'),
                'data' => 'actions',
                "searchable" => false,
                "orderable" => false,
                'visible' => true,
                "className" => "not-exportable text-end btn-toolbar"
            ],
        ];
        return $array;
    }
}
