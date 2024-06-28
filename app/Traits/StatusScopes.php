<?php

namespace App\Traits;

trait StatusScopes
{
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
