<?php

namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait ValidatesAuthRequests
{
    /**
     * Validate create user request input
     *
     * @param  Request $request
     */
    protected function validateSignUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
        ]);

        return $validator;
    }

    /**
     * Validate authenticate user request input
     *
     * @param  Request $request
     */
    protected function validateSignIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users|email',
            'password' => 'required|min:6',
        ]);

        return $validator;
    }

}
