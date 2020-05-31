<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Validators\ValidatesAuthRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends AbstractController
{
    use ValidatesAuthRequests;

    /**
     * Create user action
     *
     * @param  Request $request
     */
    public function signUp(Request $request) {

        # Validate requests
        $validator = $this->validateSignUp($request);

        if($validator->fails()) return errorResponse($validator->errors());

        $user = new User();

        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        $user->save();

        $credentials = $request->only(['email', 'password']);

        if(!$token = Auth::attempt($credentials)) {
            return errorResponse("Username or password doesn't match");
        }

        # Returning the registered user back
        return tokenResponse($token);

    }

    /**
     * Create user action
     *
     * @param  Request $request
     */
    public function signUpGuest(Request $request) {

        $guest = new User();

        $guest->is_guest = true;

        $guest->save();

        # Returning the registered user back
        return successResponse($guest);
    }

    /**
     * Sign in user action
     *
     * @param  Request $request
     */
    public function signIn(Request $request) {

        # Validate requests
        $validator = $this->validateSignIn($request);

        $credentials = $request->only(['email', 'password']);

        if($validator->fails()) {
            return errorResponse($validator->errors());
        }

        elseif(!$token = Auth::attempt($credentials)) {
            return errorResponse("Username or password doesn't match");
        }

        # Returning the registered user back
        return tokenResponse($token);
    }


}
