<?php

namespace App\Http\Controllers;

use App\Http\Requests\Group\GroupRequest;
use App\Models\Group;
use App\Services\GroupService;

class GroupController extends Controller
{
    private GroupService $groupService;

    public function __construct(GroupService $service)
    {
        $this->groupService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = $this->groupService->all();

        return response()->json($groups);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupRequest $request)
    {
        $this->groupService->create($request);

        return response()->json('The group has been created!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        $group = $this->groupService->get($group);

        return response()->json($group);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupRequest $request, Group $group)
    {
        $this->groupService->update($request, $group);

        return response()->json('The group has been updated!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $this->groupService->delete($group);

        return response()->json('The group has been deleted!', 200);
    }
}
