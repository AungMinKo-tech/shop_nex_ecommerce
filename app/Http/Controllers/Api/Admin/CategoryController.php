<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Resources\Admin\CategoryResource;
use App\Http\Resources\CategoryResource as ResourcesCategoryResource;

class CategoryController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $categories = Category::paginate(config('pagination.perPage'));
        return $this->successResponse('Categories retrieved successfully', $this->buildPaginatedResourceResponse(CategoryResource::class, $categories),200);
    }


    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return $this->successResponse('Category created successfully',new CategoryResource($category),201);
    }


    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->errorResponse('Category not found', 404);
        }

        return $this->successResponse('Category details retrieved', new CategoryResource($category),200);
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->errorResponse('Category not found', 404);
        }

        $category->update($request->validated());

        return $this->successResponse('Category updated successfully',new CategoryResource($category),201);
    }


    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->errorResponse('Category not found', 404);
        }

        $category->delete();

        return $this->successResponse('Category deleted successfully');
    }
}
