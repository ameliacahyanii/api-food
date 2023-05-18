<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'reviews_content' => $this->reviews_content,
            'user_id' => $this->user_id,
            'reviewer' => $this->whenLoaded('reviewer'),
            "created_at" => date_format($this->created_at, "Y/m/d H:i:s")
        ];
    }
}
