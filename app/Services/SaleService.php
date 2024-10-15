<?php

namespace App\Services;

use App\Http\Requests\Sale\SaleRequest;
use App\Http\Resources\Sale\SaleResource;
use App\Models\Sale;
use App\Models\Project;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class SaleService
{
    public function all(?Project $project = null): AnonymousResourceCollection
    {
        if ($project) {
            $sales = Sale::with(['project', 'company', 'user', 'status'])->where('project_id', $project->id)->paginate(20);
        } else {
            $sales = Sale::with(['project', 'company', 'user', 'status'])->paginate(20);
        }

        return SaleResource::collection($sales);
    }

    public function create(SaleRequest $request): void
    {
        $data = [
            'project_id'    => $request->project_id,
            'company_id'    => $request->company_id,
            'user_id'       => Auth::user()->id,
            'subject'       => $request->subject,
            'description'   => $request->description,
            'type'          => $request->type,
            'total'         => $request->total,
            'status_id'     => $request->status_id,
        ];

        Sale::create($data);
    }

    public function update(SaleRequest $request, Sale $sale): void
    {
        $sale->project_id   = $request->project_id;
        $sale->company_id   = $request->company_id;
        $sale->subject      = $request->subject;
        $sale->description  = $request->description;
        $sale->type         = $request->type;
        $sale->total        = $request->total;
        $sale->status_id    = $request->status_id;

        $sale->save();
    }

    public function get(Sale $sale): SaleResource
    {
        $sale->load(['project', 'company', 'user', 'status']);

        return new SaleResource($sale);
    }

    public function delete(Sale $sale): void
    {
        $sale->delete();
    }
}
