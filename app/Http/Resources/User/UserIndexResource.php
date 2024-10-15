<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'login'         => $this->login,
            'email'         => $this->email,
            'created_at'    => $this->created_at,
        ];
    }
}
