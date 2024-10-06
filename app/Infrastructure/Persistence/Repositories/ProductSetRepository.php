<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Product\Entities\ProductSet;
use App\Domain\Product\Repositories\ProductSetRepositoryInterface;
use App\Infrastructure\Persistence\EloquentModels\ProductSetEloquentModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ProductSetRepository implements ProductSetRepositoryInterface
{
    public function create(array $data): ProductSet
    {
        $productSetModel = $this->createProductSet($data);
        $isPublished = $this->createProductsForSet($productSetModel, $data['products']);
        $productSetModel->update(['published' => $isPublished]);

        return $this->toDomainEntity($productSetModel);
    }

    private function createProductSet(array $data): ProductSetEloquentModel
    {
        return ProductSetEloquentModel::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'published' => false,
        ]);
    }

    private function createProductsForSet(ProductSetEloquentModel $productSetModel, array $products): bool
    {
        $isPublished = false;

        foreach ($products as $productData) {
            $createdProduct = $productSetModel->products()->create(array_merge($productData, [
                'product_set_id' => $productSetModel->id,
            ]));

            if ($createdProduct->published) {
                $isPublished = true;
            }
        }

        return $isPublished;
    }

    private function toDomainEntity(ProductSetEloquentModel $productSetModel): ProductSet
    {
        return new ProductSet(
            $productSetModel->id,
            $productSetModel->name,
            $productSetModel->slug,
            $productSetModel->published,
            $productSetModel->products,
        );
    }

    public function findById(int $id): ?ProductSet
    {
        $productSetModel = ProductSetEloquentModel::with('products')->find($id);

        if (!$productSetModel) {
            return null;
        }

        return new ProductSet(
            $productSetModel->id,
            $productSetModel->name,
            $productSetModel->slug,
            $productSetModel->published,
            $productSetModel->products
        );
    }

    public function update(ProductSet $productSet, array $data): ProductSet
    {
        $productSetModel = ProductSetEloquentModel::findOrFail($productSet->getId());

        $productSetModel->update([
            'name' => $data['name'] ?? $productSetModel->name,
            'slug' => Str::slug($data['name'] ?? $productSetModel->name),
            'published' => $data['published'] ?? $productSetModel->published,
        ]);

        return $productSet;
    }

    public function delete(ProductSet $productSet): void
    {
        ProductSetEloquentModel::destroy($productSet->getId());
    }

    public function getPublishedSets(): Collection
    {
        return ProductSetEloquentModel::where('published', true)
            ->whereHas('products', function ($query) {
                $query->where('published', true);
            })
            ->with('products')
            ->get();
    }
}
