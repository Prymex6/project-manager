<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userService->all();

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        $this->userService->create($request);

        return response()->json('The user has been created!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user = $this->userService->get($user);

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $this->userService->update($request, $user);

        return response()->json('The user has been updated!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->userService->delete($user);

        return response()->json('The user has been deleted!', 200);
    }
}
