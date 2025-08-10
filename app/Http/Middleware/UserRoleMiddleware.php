<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        $currentUser = Auth::user();
        $currentUserRole = $currentUser->role;

        if ($role === 'customer'){
            if ($currentUserRole === 'customer') {
                return $next($request);
            }

            Log::channel('sayfood')->warning('User tried to access customer routes.', [
                'route' => $request->path(),
                'id' => $currentUser->id,
                'username' => $currentUser->username
            ]);
            return back()->withErrors(['error' => 'Unauthorized access: wrong user role!']);
        }
        if ($role === 'restaurant'){
            if ($currentUserRole === 'restaurant'){
                return $next($request);
            }

            Log::channel('sayfood')->warning('User tried to access restaurant routes.', [
                'route' => $request->path(),
                'id' => $currentUser->id,
                'username' => $currentUser->username
            ]);
            return back()->withErrors(['error' => 'Unauthorized access: wrong user role!']);
        }
        if ($role === 'admin') {
            if ($currentUserRole === 'admin') {
                return $next($request);
            }

            Log::channel('sayfood')->warning('User tried to access admin routes.', [
                'route' => $request->path(),
                'id' => $currentUser->id,
                'username' => $currentUser->username
            ]);
            return back()->withErrors(['error' => 'Unauthorized access: wrong user role!']);
        }
        if ($role === 'admincustomer') {
            if ($currentUserRole === 'customer' || $currentUserRole === 'admin') {
                return $next($request);
            }

            Log::channel('sayfood')->warning('User tried to access admincustomer routes.', [
                'route' => $request->path(),
                'id' => $currentUser->id,
                'username' => $currentUser->username
            ]);
            return back()->withErrors(['error' => 'Unauthorized access: wrong user role!']);
        }
        
        // Unexpected role (server side's fault)!
        Log::channel('sayfood')->critical('Unexpected UserRoleMiddleware usage.', [
            'route' => $request->path(),
            'user_id' => $currentUser->id,
            'expectedRole' => $role,
            'userRole' => $currentUserRole
        ]);
        abort(500, 'Invalid role middleware usage.');
    }
}
