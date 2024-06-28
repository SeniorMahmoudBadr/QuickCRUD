<?php

namespace App\Http\Resources\Api;

use App\Traits\DataTableAttributes;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChildResource extends JsonResource
{
    use DataTableAttributes;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $date = $this->created_at->locale("ar_SA")->translatedFormat("d F Y");
        // $day = date('d', strtotime($this->created_at));
        // $year = date('Y', strtotime($this->created_at));

        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_by' => $this->created_by,
            'center_id' => $this->center_id,
            'status' => $this->status,
            // 'created_at' => date('d F Y', strtotime($this->created_at)),
            'created_at' => $date,
        ];
    }
}


