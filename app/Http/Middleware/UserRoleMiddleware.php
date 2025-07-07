<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $currentUserRole = Auth::user()->role;

        if ($role === 'customer'){
            if ($currentUserRole === 'customer' || $currentUserRole === 'admin') {
                return $next($request);
            }

            abort(403, 'Unauthorized access.');
        }
        if ($role === 'restaurant'){
            if ($currentUserRole === 'restaurant'){
                return $next($request);
            }

            abort(403, 'Unauthorized access.');    
        }
        if ($role === 'admin') {
            if ($currentUserRole === 'admin') {
                return $next($request);
            }

            abort(403, 'Unauthorized access.');
        }
        
        // Unexpected role (server side's fault)!
        abort(500, 'Invalid role middleware usage.');
    }
}
