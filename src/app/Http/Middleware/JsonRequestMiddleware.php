<?php

namespace App\Http\Middleware;

use Closure;

class JsonRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     */
    public function handle($request, Closure $next)
    {

        # Allow only JSON requests
        if(!$request->isJson()) return response()->json(['status' => 'error', 'message' => 'Unauthorized Request.'], 401);

        return $next($request);
    }
}
