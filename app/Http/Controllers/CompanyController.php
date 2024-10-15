<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\CompanyRequest;
use App\Models\Company;
use App\Services\CompanyService;

class CompanyController extends Controller
{
    private CompanyService $companyService;

    public function __construct(CompanyService $service)
    {
        $this->companyService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = $this->companyService->all();

        return response()->json($companies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        $this->companyService->create($request);

        return response()->json('The company has been created!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $company = $this->companyService->get($company);

        return response()->json($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $this->companyService->update($request, $company);

        return response()->json('The company has been updated!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $this->companyService->delete($company);

        return response()->json('The company has been deleted!', 200);
    }
}
