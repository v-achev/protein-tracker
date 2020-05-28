<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends AbstractController
{

    /**
     * Get user profile action
     *
     */
    public function profile() {

        $user = Auth::user();

        return successResponse($user->toArray());
    }

    /**
     * Logout user action
     *
     */
    public function logout() {

        Auth::logout();

        return successResponse("Logged our successfully.");
    }

}
