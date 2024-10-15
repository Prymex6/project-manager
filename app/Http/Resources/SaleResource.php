<?php

namespace App\Http\Resources;

use App\Http\Resources\Company\CompanyIndexResource;
use App\Http\Resources\Project\ProjectResource;
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
            'project'       => new ProjectResource($this->project),
            'company'       => new CompanyIndexResource($this->company),
            'user'          => new UserResource($this->user),
            'subject'       => $this->subject,
            'description'   => $this->description,
            'type'          => $this->type,
            'total'         => $this->total,
            'status'        => new StatusResource($this->status)
        ];
    }
}
