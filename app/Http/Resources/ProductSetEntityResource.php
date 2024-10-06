<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductSetEntityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'slug' => $this->getSlug(),
            'products' => ProductEloquentResource::collection($this->getProducts()),
        ];
    }
}
