<?php

namespace App\Http\Resources;

use App\Traits\DataTableAttributes;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class PageResource extends JsonResource
{
    use DataTableAttributes;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name_en' => $this->{'name_en'},
            'name_ar' => $this->{'name_ar'},
            'name' => $this->{'name_' . App::getLocale()},
            'actions' => $this->actions($this),
        ];
    }
}
