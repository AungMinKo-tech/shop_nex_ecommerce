<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'message'=>$this->message,
            'user'=>new UserResource($this->whenloaded('user')),
            'product'=>new ProductResource($this->whenloaded('product')),
            'created_at'=>$this->created_at->format('Y-m-d')
        ];
    }
}
