<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
//            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'target_url' => $this->target_url,
            'expire_at' => $this->expire_at,
            'usage_count' => $this->usage_count,
            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
        ];
    }
}
