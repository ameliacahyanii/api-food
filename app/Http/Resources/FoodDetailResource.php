<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodDetailResource extends JsonResource
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
            'image' => $this->image,
            'food_name' => $this->food_name,
            'food_type' => $this->food_type,
            'reviews_content' => $this->reviews_content,
            'created_at' => date_format($this->created_at, "Y/m/d H:i:s"),
            'author' => $this->author,
            'writer' => $this->whenLoaded('writer'),
            'reviews' => $this->whenLoaded('reviews', function() {
                return collect($this->reviews)->each(function ($review) {
                    $review->reviewer;
                    return $review;
                });
            }),

            'review_total' =>$this->whenLoaded('reviews', function() {
                return $this->reviews->count();
            })
        ];
    }
}
