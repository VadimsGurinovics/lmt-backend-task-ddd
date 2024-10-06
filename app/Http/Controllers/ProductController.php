<?php

namespace App\Http\Controllers;

use App\Domain\Product\Services\ProductService;
use App\Http\Resources\ProductEntityResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_set_id' => 'required|exists:product_sets,id',
            'sku' => 'required|string|unique:products,sku',
            'name' => 'required|string|max:40',
            'type' => 'required|in:device,service',
            'condition' => 'required|in:new,used,refurbished',
            'description_title' => 'required|string|max:255',
            'description_text' => 'required|string',
            'price' => 'required|numeric|min:0',
            'wholesale_price' => 'nullable|numeric|min:0',
            'published' => 'required|boolean',
        ]);
        $product = $this->productService->createProduct($data);

        return new ProductEntityResource($product);
    }

    public function update(Request $request, $id): ProductEntityResource
    {
        $product = $this->productService->getProductById($id);
        $data = $request->validate([
            'sku' => 'sometimes|string|unique:products,sku,' . $product->getId(),
            'name' => 'sometimes|string|max:40',
            'type' => 'sometimes|in:device,service',
            'condition' => 'sometimes|in:new,used,refurbished',
            'description_title' => 'sometimes|string|max:255',
            'description_text' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0',
            'wholesale_price' => 'nullable|numeric|min:0',
            'published' => 'sometimes|boolean',
        ]);

        $updatedProduct = $this->productService->updateProduct($product, $data);

        return new ProductEntityResource($updatedProduct);
    }

    public function destroy($id): JsonResponse
    {
        $this->productService->deleteProductById($id);

        return response()->json(null, 204);
    }
}
