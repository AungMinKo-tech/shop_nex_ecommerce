<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\Admin\ProductRequest;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $products = Product::paginate(config('pagination.perPage'));

        return $this->successResponse('Products retrieved successfully', $this->buildPaginatedResourceResponse(ProductResource::class, $products), 200);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        $filename = uniqid() . $request->file('photo')->getClientOriginalName();
        $request->file('photo')->move(public_path('product_image/'), $filename);
        $data['photo'] = $filename;

        $product = Product::create($data);

        return $this->successResponse('Product created successfully', new ProductResource($product), 201);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->errorResponse('Product not found', 404);
        }

        return $this->successResponse('Product details retrieved', new ProductResource($product), 200);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->errorResponse('Product not found', 404);
        }

        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($product->photo) {
                $oldFilePath = public_path('product_image/' . $product->photo);

                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            $filename = uniqid() . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path('product_image/'), $filename);
            $data['photo'] = $filename;
        }

        $product->update($data);

        return $this->successResponse('Product updated successfully', new ProductResource($product), 201);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->errorResponse('Product not found', 404);
        }

        if ($product->photo) {
            $oldFilePath = public_path('product_image/' . $product->photo);

            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        $product->delete();

        return $this->successResponse('Product deleted successfully');
    }
}
