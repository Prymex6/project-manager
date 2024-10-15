<?php

namespace App\Http\Controllers;

use App\Http\Requests\File\FileRequest;
use App\Models\File;
use App\Models\Project;
use App\Services\FileService;

class FileController extends Controller
{
    private FileService $fileService;

    public function __construct(FileService $service)
    {
        $this->fileService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Project $project = null)
    {
        $files = $this->fileService->all($project);

        return response()->json($files);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FileRequest $request)
    {
        $this->fileService->create($request);

        return response()->json('The file has been created!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        $file = $this->fileService->get($file);

        return response()->json($file);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FileRequest $request, File $file)
    {
        $this->fileService->update($request, $file);

        return response()->json('The file has been updated!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        $this->fileService->delete($file);

        return response()->json('The file has been deleted!', 200);
    }
}
