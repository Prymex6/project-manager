<?php

namespace App\Http\Controllers;

use App\Http\Requests\Discussion\DiscussionRequest;
use App\Models\Discussion;
use App\Models\Project;
use App\Services\DiscussionService;

class DiscussionController extends Controller
{
    private DiscussionService $discussionService;

    public function __construct(DiscussionService $service)
    {
        $this->discussionService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Project $project = null)
    {
        $discussions = $this->discussionService->all($project);

        return response()->json($discussions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiscussionRequest $request)
    {
        $this->discussionService->create($request);

        return response()->json('The discussion has been created!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Discussion $discussion)
    {
        $discussion = $this->discussionService->get($discussion);

        return response()->json($discussion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiscussionRequest $request, Discussion $discussion)
    {
        $this->discussionService->update($request, $discussion);

        return response()->json('The discussion has been updated!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discussion $discussion)
    {
        $this->discussionService->delete($discussion);

        return response()->json('The discussion has been deleted!', 200);
    }
}
