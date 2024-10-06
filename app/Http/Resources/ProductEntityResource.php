<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductEntityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getId(),
            'sku' => $this->getSku(),
            'name' => $this->getName(),
            'slug' => $this->getSlug(),
            'type' => $this->getType(),
            'condition' => $this->getCondition(),
            'description_title' => $this->getDescriptionTitle(),
            'description_text' => $this->getDescriptionText(),
            'price' => $this->getPrice()->getValue(),
            'published' => $this->isPublished(),
        ];
    }
}
