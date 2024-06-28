<?php

namespace App\Models;
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Role extends SpatieRole
{

    protected $fillable = [
        'name',
        'guard_name',
    ];

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
                'title' => trans('app.Name'),
                'data' => 'name',
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
                "className" => "text-center"
            ],
        ];
        return $array;
    }

    // public function managers(){
    //     return $this->hasMany(ModelHasRole::class,'role_id');
    // }

//    public function managers(): HasManyThrough
//    {
//        return $this->hasManyThrough(
//            User::class,
//            ModelHasRole::class,
//            'role_id', // Foreign key on the ModelHasRole table...
//            'id', // Foreign key on the User table...
//            'id', // Local key on the Rol table...
//            'model_id' // Local key on the ModelHasRole table...
//        );
//    }
}
