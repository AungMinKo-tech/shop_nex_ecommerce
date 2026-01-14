<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class PaymentAccountResource extends JsonResource
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
            'accountNumber' => $this->account_number,
            'accountName' => $this->account_name,
            'accountType' => $this->account_type
        ];
    }
}
