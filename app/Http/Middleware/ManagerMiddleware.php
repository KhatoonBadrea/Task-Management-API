<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\SupportFacades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ManagerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is invalid'], 401);
        }

        if ($user->state !== 'manager') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
