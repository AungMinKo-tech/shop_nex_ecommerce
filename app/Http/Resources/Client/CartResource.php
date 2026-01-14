<?php

namespace App\Http\Resources\Client;

use App\Http\Resources\Admin\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->user_id,
            'productId' => $this->product_id,
            'product' => new ProductResource($this->whenLoaded('product')),
        ];
    }
}
