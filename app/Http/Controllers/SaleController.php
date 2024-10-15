<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sale\SaleRequest;
use App\Models\Project;
use App\Models\Sale;
use App\Services\SaleService;

class SaleController extends Controller
{
    private SaleService $saleService;

    public function __construct(SaleService $service)
    {
        $this->saleService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Project $project = null)
    {
        $sales = $this->saleService->all($project);

        return response()->json($sales);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaleRequest $request)
    {
        $this->saleService->create($request);

        return response()->json('The sale has been created!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        $sale = $this->saleService->get($sale);

        return response()->json($sale);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaleRequest $request, Sale $sale)
    {
        $this->saleService->update($request, $sale);

        return response()->json('The sale has been updated!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $this->saleService->delete($sale);

        return response()->json('The sale has been deleted!', 200);
    }
}
