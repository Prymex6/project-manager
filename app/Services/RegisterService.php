<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    public function store($request)
    {
        $user = [
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'login'         => $request->login,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
        ];

        return User::firstOrCreate($user);
    }
}
