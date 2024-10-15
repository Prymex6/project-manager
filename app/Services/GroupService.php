<?php

namespace App\Services;

use App\Http\Requests\Group\GroupRequest;
use App\Http\Resources\Group\GroupResource;
use App\Models\Group;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GroupService
{
    public function all(): AnonymousResourceCollection
    {
        $groups = Group::paginate(20);

        return GroupResource::collection($groups);
    }

    public function create(GroupRequest $request): void
    {
        $data = [
            'name'          => $request->name,
            'description'   => $request->description,
            'color'         => $request->color,
        ];

        Group::create($data);
    }

    public function update(GroupRequest $request, Group $group): void
    {
        $group->name        = $request->name;
        $group->description = $request->description;
        $group->color       = $request->color;

        $group->save();
    }

    public function get(Group $group): GroupResource
    {
        return new GroupResource($group);
    }

    public function delete(Group $group): void
    {
        $group->delete();
    }
}
