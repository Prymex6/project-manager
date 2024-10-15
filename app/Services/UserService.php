<?php

namespace App\Services;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\User\UserIndexResource;
use App\Http\Resources\User\UserShowResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function all(): AnonymousResourceCollection
    {

        $users = User::paginate(20);

        return UserIndexResource::collection($users);
    }

    public function create(RegisterRequest $request): void
    {
        $data = [
            'first_name'        => $request->first_name,
            'last_name'         => $request->last_name,
            'login'             => $request->login,
            'email'             => $request->email,
            'email_verified_at' => now(),
            'password'          => Hash::make($request->password),
        ];

        User::create($data);
    }

    public function update(UserUpdateRequest $request, User $user): void
    {
        $user->first_name   = $request->first_name;
        $user->last_name    = $request->last_name;
        $user->login        = $request->login;
        $user->email        = $request->email;

        $user->save();
    }

    public function get(User $user): UserShowResource
    {
        return new UserShowResource($user);
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}
