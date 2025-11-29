<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category' => $this->category ? $this->category->name : null,
            'name' => $this->name,
            'description' => $this->description,
            'price' => number_format($this->price, 2),
            'images' => [
                'main' => $this->main_image ? asset($this->main_image) : null,
                'front' => $this->front_image ? asset($this->front_image) : null,
                'back' => $this->back_image ? asset($this->back_image) : null,
                'side' => $this->side_image ? asset($this->side_image) : null,
                'gallery' => $this->additionalImages->map(function ($img) {
                    return asset($img->image);
                }),
            ],
        ];
    }
}