<?php

namespace App\Domain\Product\Services;

use App\Domain\Product\Entities\ProductSet;
use App\Domain\Product\Repositories\ProductSetRepositoryInterface;
use Illuminate\Support\Collection;

class ProductSetService
{
    private ProductSetRepositoryInterface $productSetRepository;

    public function __construct(ProductSetRepositoryInterface $productSetRepository)
    {
        $this->productSetRepository = $productSetRepository;
    }

    public function createProductSet(array $data): ProductSet
    {
        return $this->productSetRepository->create($data);
    }

    public function updateProductSet(ProductSet $productSet, array $data): ProductSet
    {
        return $this->productSetRepository->update($productSet, $data);
    }

    public function deleteProductSet(ProductSet $productSet): void
    {
        $this->productSetRepository->delete($productSet);
    }

    public function findProductSetById(int $id): ProductSet
    {
        return $this->productSetRepository->findById($id);
    }

    public function getPublishedProductSets(): Collection
    {
        return $this->productSetRepository->getPublishedSets();
    }
}
