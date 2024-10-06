<?php

namespace App\Domain\Product\Repositories;

use App\Domain\Product\Entities\ProductSet;
use Illuminate\Support\Collection;

interface ProductSetRepositoryInterface
{
    public function create(array $data): ProductSet;

    public function update(ProductSet $productSet, array $data): ProductSet;

    public function delete(ProductSet $productSet): void;

    public function findById(int $id): ?ProductSet;

    public function getPublishedSets(): Collection;
}
