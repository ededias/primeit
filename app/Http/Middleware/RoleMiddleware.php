<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        try {
           
            // Tenta autenticar o usuário pelo JWT
            $user = JWTAuth::parseToken()->authenticate();
            
            // Verifica se o usuário tem o papel
            if (!$user || !$user->hasRole($role)) {
                return response()->json(['error' => 'access denied'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token inválido ou expirado'], 401);
        }

        return $next($request);

    }
}
