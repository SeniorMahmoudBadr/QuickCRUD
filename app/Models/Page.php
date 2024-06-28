<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'name_en',
        'name_ar',
        'route',
        'controller',
        'blade',
        'javascript',
        'parent_id',
        'position',
        'display',
        'role_id',
        'role_editable',
        'sort',
    ];

    public function relatedPage()
    {
        // return $this->hasManyThrough(
        //     Page::class,
        //     RelatedPage::class,
        //     'parent_id',
        //     'parent_id',
        //     'id',
        //     'id'
        // );
        return $this->hasMany(RelatedPage::class, 'parent_id');
    }

    public function childPage()
    {
        return $this->hasOne(RelatedPage::class, 'child_id');
    }

    public function hasParent()
    {
        return $this->hasOne(RelatedPage::class, 'parent_id');
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
                "className" => "text-center"
            ],
            [
//                'title' => trans('Name'),
                'data' => 'name_en',
                "searchable" => true,
                "orderable" => false,
                'visible' => false,
                "className" => "text-center"
            ],
            [
//                'title' => trans('Name'),
                'data' => 'name_ar',
                "searchable" => true,
                "orderable" => false,
                'visible' => false,
                "className" => "text-center"
            ],
            [
                'title' => trans('app.Name'),
                'data' => 'name',
                "searchable" => false,
                "orderable" => false,
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
