<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\Admin\ProductRequest;
use App\Http\Resources\Admin\ProductResource;


class ProductController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $products = Product::paginate(config('pagination.perPage'));
        return $this->successResponse('Products retrieved successfully', $this->buildPaginatedResourceResponse(ProductResource::class, $products),200);

    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());
        return $this->successResponse('Product created successfully',new ProductResource($product), 201);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->errorResponse('Product not found', 404);
        }

        return $this->successResponse('Product details retrieved',new ProductResource($product),200);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->errorResponse('Product not found', 404);
        }

        $product->update($request->validated());
        return $this->successResponse('Product updated successfully', new ProductResource($product),201);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->errorResponse('Product not found', 404);
        }

        $product->delete();
        return $this->successResponse('Product deleted successfully');
    }
}
