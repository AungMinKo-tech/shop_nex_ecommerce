<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Helper\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Api\V1\CategoryRequest;
use Illuminate\Http\JsonResponse;
class CategoryController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $categories = Category::all();
        return $this->successResponse('Categories retrieved successfully', $categories);
    }


    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return $this->successResponse('Category created successfully', $category, 201);
    }


    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->errorResponse('Category not found', 404);
        }

        return $this->successResponse('Category details retrieved', $category);
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->errorResponse('Category not found', 404);
        }

        $category->update($request->validated());

        return $this->successResponse('Category updated successfully', $category);
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
