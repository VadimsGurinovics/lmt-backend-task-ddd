<?php

namespace App\Domain\Product\DTOs;

use App\Domain\Product\ValueObjects\Price;

class ProductDTO
{
    public ?int $id;
    public string $sku;
    public string $name;
    public string $slug;
    public string $type;
    public string $condition;
    public string $descriptionTitle;
    public string $descriptionText;
    public Price $price;
    public Price $wholesalePrice;
    public bool $published;
    public ?int $productSetId;

    public function __construct(
        ?int $id,
        string $sku,
        string $name,
        string $slug,
        string $type,
        string $condition,
        string $descriptionTitle,
        string $descriptionText,
        Price $price,
        Price $wholesalePrice,
        bool $published = false,
        ?int $productSetId = null
    ) {
        $this->id = $id;
        $this->sku = $sku;
        $this->name = $name;
        $this->slug = $slug;
        $this->type = $type;
        $this->condition = $condition;
        $this->descriptionTitle = $descriptionTitle;
        $this->descriptionText = $descriptionText;
        $this->price = $price;
        $this->wholesalePrice = $wholesalePrice;
        $this->published = $published;
        $this->productSetId = $productSetId;
    }
}
