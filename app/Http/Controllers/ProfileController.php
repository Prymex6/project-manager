<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private ProfileService $profileService;

    public function __construct(ProfileService $service)
    {
        $this->profileService = $service;
    }

    public function emailUpdate() {}

    public function passwordUpdate() {}
}
