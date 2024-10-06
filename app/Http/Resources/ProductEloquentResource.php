<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductEloquentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'name' => $this->name,
            'slug' => $this->slug,
            'type' => $this->type,
            'condition' => $this->condition,
            'description_title' => $this->descriptionTitle,
            'description_text' => $this->descriptionText,
            'price' => $this->price,
            'published' => $this->published,
        ];
    }
}
