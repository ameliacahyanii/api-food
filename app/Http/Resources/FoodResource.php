<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
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
            'food_name' => $this->food_name,
            'food_type' => $this->food_type,
            'recipe_content' => $this->recipe_content,
            'created_at' => date_format($this->created_at, "Y/m/d H:i:s") 
        ];
    }
}
