<?php

namespace App\Services;

use App\Http\Requests\File\FileRequest;
use App\Http\Resources\File\FileIndexResource;
use App\Http\Resources\File\FileShowResource;
use App\Models\Project;
use App\Models\File;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class FileService
{
    public function all(?Project $project = null): AnonymousResourceCollection
    {
        if ($project) {
            $files = File::with(['uploader', 'project'])->where('project_id', $project->id)->paginate(20);
        } else {
            $files = File::with(['uploader', 'project'])->paginate(20);
        }

        return FileIndexResource::collection($files);
    }

    public function create(FileRequest $request): void
    {
        $data = [
            'project_id'    => $request->project_id,
            'uploaded_by'   => Auth::user()->id,
            'name'          => $request->name,
            'type'          => $request->type,
            'subject'       => $request->subject,
            'description'   => $request->description,
            'download'      => $request->download ?? 0,
        ];

        File::create($data);
    }

    public function update(FileRequest $request, File $file): void
    {
        $file->project_id   = $request->project_id;
        $file->name         = $request->name;
        // $file->created_by       = $request->created_by;
        $file->type         = $request->type;
        $file->subject      = $request->subject;
        $file->description  = $request->description;
        $file->download     = $request->download ?? 0;

        $file->save();
    }

    public function get(File $file): FileShowResource
    {
        $file->load(['comments', 'uploader', 'project']);

        return new FileShowResource($file);
    }

    public function delete(File $file): void
    {
        $file->delete();
    }
}
