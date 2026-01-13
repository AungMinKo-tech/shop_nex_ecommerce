<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Helper\ApiResponse;
use App\Http\Requests\Api\V1\ProductRequest;


class ProductController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $products = Product::all();
        return $this->successResponse('Products retrieved successfully', $products);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());
        return $this->successResponse('Product created successfully', $product, 201);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->errorResponse('Product not found', 404);
        }

        return $this->successResponse('Product details retrieved', $product);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->errorResponse('Product not found', 404);
        }

        $product->update($request->validated());
        return $this->successResponse('Product updated successfully', $product);
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
