<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\CommentRequest;
use App\Http\Resources\Admin\CommentResource;


class CommentController extends Controller
{
    use ApiResponse;

    public function index(){
        $comments = Comment::with(['user','product'])->paginate(config('pagination.perPage'));

        return $this->successResponse('Comments retrieved successfully', $this->buildPaginatedResourceResponse(CommentResource::class, $comments), 200);
    }

    public function store(CommentRequest $request){
        $data = $request->validation();
        $data['user_id'] = Auth::id();
        $comment = Comment::create($data);
        $comment->load(['user','product']);
        return $this->successResponse( 'Comment posted successfully' , new CommentResource($comment), 201);
    }
}
