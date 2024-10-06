<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Product\DTOs\ProductDTO;
use App\Domain\Product\Entities\Product;
use App\Domain\Product\Repositories\ProductRepositoryInterface;
use App\Domain\Product\ValueObjects\Price;
use App\Infrastructure\Persistence\EloquentModels\ProductEloquentModel;

class ProductRepository implements ProductRepositoryInterface
{
    public function create(array $data): Product
    {
        $productModel = ProductEloquentModel::create($data);
        $productDTO = new ProductDTO(
            id: $productModel->id,
            sku: $productModel->sku,
            name: $productModel->name,
            slug: $productModel->slug,
            type: $productModel->type,
            condition: $productModel->condition,
            descriptionTitle: $productModel->description_title,
            descriptionText: $productModel->description_text,
            price: new Price($productModel->price),
            wholesalePrice: new Price($productModel->wholesale_price),
            published: $productModel->published,
            productSetId: $productModel->product_set_id
        );

        return new Product($productDTO);
    }

    public function update(Product $product, array $data): Product
    {
        $productModel = ProductEloquentModel::findOrFail($product->getId());
        $productModel->update($data);
        $productDTO = new ProductDTO(
            id: $productModel->id,
            sku: $productModel->sku,
            name: $productModel->name,
            slug: $productModel->slug,
            type: $productModel->type,
            condition: $productModel->condition,
            descriptionTitle: $productModel->description_title,
            descriptionText: $productModel->description_text,
            price: new Price($productModel->price),
            wholesalePrice: new Price($productModel->wholesale_price),
            published: $productModel->published,
            productSetId: $productModel->product_set_id
        );

        return new Product($productDTO);
    }

    public function delete(Product $product): void
    {
        ProductEloquentModel::destroy($product->getId());
    }

    public function save(ProductDTO $data): Product
    {
        $productModel = ProductEloquentModel::create([
            'name' => $data->name,
            'slug' => $data->slug,
            'sku' => $data->sku,
            'type' => $data->type,
            'condition' => $data->condition,
            'description_title' => $data->descriptionTitle,
            'description_text' => $data->descriptionText,
            'price' => $data->price->getValue(),
            'wholesale_price' => $data->wholesalePrice->getValue(),
            'published' => $data->published,
            'product_set_id' => $data->productSetId,
        ]);

        return new Product($data);
    }

    public function findById(int $id): ?Product
    {
        $productModel = ProductEloquentModel::find($id);

        if (!$productModel) {
            return null;
        }

        $productDTO = new ProductDTO(
            id: $productModel->id,
            sku: $productModel->sku,
            name: $productModel->name,
            slug: $productModel->slug,
            type: $productModel->type,
            condition: $productModel->condition,
            descriptionTitle: $productModel->description_title,
            descriptionText: $productModel->description_text,
            price: new Price($productModel->price),
            wholesalePrice: new Price($productModel->wholesale_price),
            published: $productModel->published,
            productSetId: $productModel->product_set_id
        );

        return new Product($productDTO);
    }
}
