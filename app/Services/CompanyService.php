<?php

namespace App\Services;

use App\Http\Requests\Company\CompanyRequest;
use App\Http\Resources\Company\CompanyIndexResource;
use App\Http\Resources\Company\CompanyShowResource;
use App\Models\Company;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompanyService
{
    public function all(): AnonymousResourceCollection
    {
        $companies = Company::paginate(20);

        return CompanyIndexResource::collection($companies);
    }

    public function create(CompanyRequest $request): void
    {
        $data = [
            'name'          => $request->name,
            'description'   => $request->description,
            'telephone'     => $request->telephone,
            'website'       => $request->website,
        ];

        Company::create($data);
    }

    public function update(CompanyRequest $request, Company $company): void
    {
        $company->name          = $request->name;
        $company->description   = $request->description;
        $company->telephone     = $request->telephone;
        $company->website       = $request->website;

        $company->save();
    }

    public function get(Company $company): CompanyShowResource
    {
        $company->load(['sales', 'projects']);

        return new CompanyShowResource($company);
    }

    public function delete(Company $company): void
    {
        $company->delete();
    }
}
