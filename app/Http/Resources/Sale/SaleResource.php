<?php

namespace App\Http\Resources\Sale;

use App\Http\Resources\Company\CompanyIndexResource;
use App\Http\Resources\StatusResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'project'       => $this->project->name,
            'company'       => new CompanyIndexResource($this->whenLoaded('company')),
            'user'          => new UserResource($this->whenLoaded('user')),
            'subject'       => $this->subject,
            'description'   => $this->description,
            'type'          => $this->type,
            'total'         => $this->total,
            'status'        => new StatusResource($this->whenLoaded('status')),
        ];
    }
}
