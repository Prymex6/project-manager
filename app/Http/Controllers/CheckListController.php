<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckList\CheckListRequest;
use App\Models\CheckList;
use App\Models\Task;
use App\Services\CheckListService;
use Illuminate\Http\JsonResponse;

class CheckListController extends Controller
{
    private CheckListService $checkListService;

    public function __construct(CheckListService $service)
    {
        $this->checkListService = $service;
    }

    public function store(CheckListRequest $request, Task $task): JsonResponse
    {
        $this->checkListService->create($request, $task);

        return response()->json('The checklist has been created!', 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CheckListRequest $request, CheckList $checkList): JsonResponse
    {
        $this->checkListService->update($request, $checkList);

        return response()->json('The checklist has been updated!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CheckList $checkList): JsonResponse
    {
        $this->checkListService->delete($checkList);

        return response()->json('The checklist has been deleted!', 200);
    }
}
