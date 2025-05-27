<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     * @param  string|null  $guard
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role, string $guard = null): Response
    {
        // Check if user is authenticated
        if (!Auth::guard($guard)->check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
            return redirect()->guest(route('login'));
        }

        $user = Auth::guard($guard)->user();

        // Check if user has the required role using Spatie Laravel Permission
        if (!$user->hasRole($role)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Access denied. You do not have the required role.',
                    'required_role' => $role
                ], 403);
            }
            
            abort(403, 'Access denied. You do not have the required role: ' . $role);
        }

        return $next($request);
    }
}