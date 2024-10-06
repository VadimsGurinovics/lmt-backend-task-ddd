<?php

namespace App\Domain\Product\Entities;

use Illuminate\Support\Str;

class ProductSet
{
    private ?int $id;
    private string $name;
    private string $slug;
    private bool $published;
    private mixed $products;

    public function __construct(?int $id, string $name, string $slug, bool $published = false, $products = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->published = $published;
        $this->products = $products;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function isPublished(): bool
    {
        return $this->published && $this->hasPublishedProducts();
    }

    public function setPublished(bool $published): void
    {
        $this->published = $published;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function hasPublishedProducts(): bool
    {
        foreach ($this->products as $product) {
            if ($product->isPublished()) {
                return true;
            }
        }
        return false;
    }
}
