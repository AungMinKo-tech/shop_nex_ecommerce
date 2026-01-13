<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{
    use ApiResponse, HasApiTokens, HasFactory, Notifiable;

    public function index()
    {
        $users = User::with(['role'])->paginate(config('pagination.perPage'));

        return $this->successResponse('User retrieved successfully', $this->buildPaginatedResourceResponse(UserResource::class, $users), 200);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->errorResponse('User not found.', 404);
        }

        return $this->successResponse('User Fetched Successfully', new UserResource($user), 200);
    }

    public function destroy($id)
    {
        $user = User::where($id);

        if (!$user) {
            return $this->errorResponse('User not found.', 404);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
        ], 204);
    }
}
