<?php

namespace App\Domain\Product\Services;

use App\Domain\Product\DTOs\ProductDTO;
use App\Domain\Product\Entities\Product;
use App\Domain\Product\Events\ProductCreated;
use App\Domain\Product\Repositories\ProductRepositoryInterface;
use App\Domain\Product\ValueObjects\Price;
use Illuminate\Support\Str;

class ProductService
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function createProduct(array $data): Product
    {
        $productDTO = new ProductDTO(
            id: null,
            name: $data['name'],
            sku: $data['sku'],
            slug: Str::slug($data['name']),
            type: $data['type'],
            condition: $data['condition'],
            descriptionTitle: $data['description_title'],
            descriptionText: $data['description_text'],
            price: new Price($data['price']),
            wholesalePrice: new Price($data['wholesale_price'] ?? 0),
            published: $data['published'] ?? false,
            productSetId: $data['product_set_id'] ?? null
        );
        $product = $this->productRepository->save($productDTO);

        event(new ProductCreated($product));

        return $product;
    }

    public function updateProduct(Product $product, array $data): Product
    {
        return $this->productRepository->update($product, $data);
    }

    public function deleteProduct(Product $product): void
    {
        $this->productRepository->delete($product);
    }

    public function deleteProductById(int $id): void
    {
        $product = $this->productRepository->findById($id);

        $this->productRepository->delete($product);
    }

    public function getProductById(int $id)
    {
        return $this->productRepository->findById($id);
    }
}
