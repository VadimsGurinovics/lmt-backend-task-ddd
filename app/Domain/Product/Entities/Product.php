<?php

namespace App\Domain\Product\Entities;

use App\Domain\Product\ValueObjects\Price;
use App\Domain\Product\DTOs\ProductDTO;

class Product
{
    private ?int $id;
    private string $sku;
    private string $name;
    private string $slug;
    private string $type;
    private string $condition;
    private string $descriptionTitle;
    private string $descriptionText;
    private Price $price;
    private Price $wholesalePrice;
    private bool $published;
    private ?int $productSetId;

    public function __construct(ProductDTO $data)
    {
        $this->id = $data->id;
        $this->name = $data->name;
        $this->sku = $data->sku;
        $this->slug = $data->slug;
        $this->type = $data->type;
        $this->condition = $data->condition;
        $this->descriptionTitle = $data->descriptionTitle;
        $this->descriptionText = $data->descriptionText;
        $this->price = $data->price;
        $this->wholesalePrice = $data->wholesalePrice;
        $this->published = $data->published;
        $this->productSetId = $data->productSetId;
    }

    public function publish(): void
    {
        $this->published = true;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getCondition(): string
    {
        return $this->condition;
    }

    public function getDescriptionTitle(): string
    {
        return $this->descriptionTitle;
    }

    public function getDescriptionText(): string
    {
        return $this->descriptionText;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }

    public function getWholesalePrice(): Price
    {
        return $this->wholesalePrice;
    }

    public function isPublished(): bool
    {
        return $this->published;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getProductSetId(): ?int
    {
        return $this->productSetId;
    }
}
