<?php

namespace App\Http\Controllers;

use App\Domain\Product\Services\ProductSetService;
use App\Http\Resources\ProductSetEloquentResource;
use App\Http\Resources\ProductSetEntityResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductSetController extends Controller
{
    protected ProductSetService $productSetService;

    public function __construct(ProductSetService $productSetService)
    {
        $this->productSetService = $productSetService;
    }

    /*
     * Return all published product sets with at least one published product
     */
    public function index(): AnonymousResourceCollection
    {
        $productSets = $this->productSetService->getPublishedProductSets();

        return ProductSetEloquentResource::collection($productSets);
    }

    /*
     * Create a new product set
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:60',
            'published' => 'boolean',
            'products' => 'required|array',
            'products.*.name' => 'required|string|max:40',
            'products.*.sku' => 'required|string|unique:products,sku',
            'products.*.type' => 'required|in:device,service',
            'products.*.condition' => 'required|in:new,used,refurbished',
            'products.*.description_title' => 'required|string|max:255',
            'products.*.description_text' => 'required|string',
            'products.*.price' => 'required|numeric|min:0',
            'products.*.wholesale_price' => 'nullable|numeric|min:0',
            'products.*.published' => 'required|boolean',
        ]);
        $productSet = $this->productSetService->createProductSet($data);

        return (new ProductSetEntityResource($productSet))
            ->response()
            ->setStatusCode(201);
    }

    /*
     * Update a product set by ID
     */
    public function update(Request $request, $id): ProductSetEntityResource
    {
        $productSet = $this->productSetService->findProductSetById($id);
        $data = $request->validate([
            'name' => 'sometimes|string|max:60',
            'published' => 'boolean',
            'products' => 'array',
            'products.*.id' => 'nullable|exists:products,id',
            'products.*.name' => 'required|string|max:40',
            'products.*.sku' => 'required|string',
            'products.*.type' => 'required|in:device,service',
            'products.*.condition' => 'required|in:new,used,refurbished',
            'products.*.description_title' => 'required|string|max:255',
            'products.*.description_text' => 'required|string',
            'products.*.price' => 'required|numeric|min:0',
            'products.*.wholesale_price' => 'nullable|numeric|min:0',
            'products.*.published' => 'required|boolean',
        ]);
        $updatedProductSet = $this->productSetService->updateProductSet($productSet, $data);

        return new ProductSetEntityResource($updatedProductSet);
    }

    /*
     * Delete a product set by ID
     */
    public function destroy($id): JsonResponse
    {
        $productSet = $this->productSetService->findProductSetById($id);

        $this->productSetService->deleteProductSet($productSet);

        return response()->json(null, 204);
    }
}
