<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        "name_en",
        "name_ar",
        "active",
    ];

    public function scopeApplyFilters($query)
    {
        $query->when(request()->row_id, function ($q) {
            $q->where("user_id", request()->row_id);
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
                'title' => trans('app.English Name'),
                'data' => 'name_en',
                "searchable" => true,
                "orderable" => true,
                'visible' => true,
                "className" => "text-center"
            ],
            [
                'title' => trans('app.Arabic Name'),
                'data' => 'name_ar',
                "searchable" => true,
                "orderable" => true,
                'visible' => true,
                "className" => "text-center"
            ],
            [
                'title' => trans('app.Status'),
                'data' => 'active',
                "searchable" => true,
                "orderable" => true,
                'visible' => true,
                "className" => "text-center"
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
