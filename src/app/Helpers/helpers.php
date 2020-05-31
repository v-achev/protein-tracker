<?php

use Illuminate\Support\Facades\Auth;

if (! function_exists('errorResponse')) {

    function errorResponse($data, $statusCode = 400) {
        return response()->json([
            'status' => 'error',
            'data' => $data
        ], $statusCode);
    }

}

if (! function_exists('successResponse')) {

    function successResponse($data, $statusCode = 200) {
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], $statusCode);
    }

}

if (! function_exists('tokenResponse')) {

    function tokenResponse($token, $data = [], $statusCode = 200) {

        $responseData = array_merge($data, [
            'token' => $token,
            'token_expire' => Auth::factory()->getTTL() * 60
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $responseData
        ], $statusCode);
    }

}
