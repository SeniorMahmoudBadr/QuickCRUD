<?php

namespace App\Http\Resources;

use App\Traits\DataTableAttributes;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Str;

class PermissionResource extends JsonResource
{
    use DataTableAttributes;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $text ='<span class="badge badge-light-dark me-2">' . ucfirst($this->method) . '</span>';
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => strtoupper($this->type),
            'has_params' => $this->has_params?'<span class="badge badge-light-success me-2">TRUE</span>':'<span class="badge badge-light-danger me-2">FALSE</span>',
            'method' => $text,
            'status' => $this->status($this),
            'actions' => $this->actions($this)
        ];
    }
}
