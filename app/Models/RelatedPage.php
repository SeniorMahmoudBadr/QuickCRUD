<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatedPage extends Model
{
    protected $fillable=[
        'child_id',
        'parent_id',
        'type',
        'btn_color',
        'into_btn_action',
    ];

    public function child(){
        return $this->belongsTo(Page::class,'child_id');
    }

    public function parent(){
        return $this->belongsTo(Page::class,'parent_id');
    }
}
