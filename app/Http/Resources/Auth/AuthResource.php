<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $data = [
            'user' => [
                'id' => $this['user']->id,
                'userName' => $this['user']->name,
                'email' => $this['user']->email,
                'roleId' => $this['user']->role_id,
                'createdAt' => $this['user']->created_at,
                'updatedAt' => $this['user']->updated_at,
            ],
            'token' => $this['accessToken'],
        ];

        if (isset($this['refreshToken'])) {
            $data['refresh_token'] = $this['refreshToken'];
        }

        return $data;
    }
}
