<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Resources\Admin\RoleResource;
use App\Models\Role;

class RoleController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $roles = Role::paginate(config('pagination.perPage'));

        if (!$roles) {
            return $this->errorResponse('Role not found', 404);
        }

        return $this->successResponse('Role retrieved successfully', $this->buildPaginatedResourceResponse(RoleResource::class, $roles), 200);
    }
}
