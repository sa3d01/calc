<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'user not found'], 400);
            }
            if ($user->banned==1){
                $response = [
                    'status' => 401,
                    'message' => 'تم حظرك من قبل إدارة التطبيق ..',
                ];
                return response()->json($response, 401);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
        return $next($request);
    }
}
