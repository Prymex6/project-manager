<?php

namespace App\Http\Resources\Company;

use App\Http\Resources\Project\ProjectResource;
use App\Http\Resources\SaleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'          => $this->name,
            'description'   => $this->description,
            'telephone'     => $this->telephone,
            'website'       => $this->website,
            'projects'      => ProjectResource::collection($this->whenLoaded('projects')),
            'sales'         => SaleResource::collection($this->whenLoaded('sales')),
        ];
    }
}
