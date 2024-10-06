<?php

namespace App\Domain\Product\Repositories;

use App\Domain\Product\Entities\Product;
use App\Domain\Product\DTOs\ProductDTO;

interface ProductRepositoryInterface
{
    public function save(ProductDTO $data): Product;

    public function create(array $data): Product;

    public function update(Product $product, array $data): Product;

    public function delete(Product $product): void;

    public function findById(int $id): ?Product;
}
