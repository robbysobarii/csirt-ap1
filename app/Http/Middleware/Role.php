<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Role as ControllersRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, string ...$role)
    {
        $user = auth()->user();

        // Check if the requested route is the login route
        if ($request->routeIs('user.laporkanInsiden')) {
            // Allow access to the login route
            return $next($request);
        }

        // Check if the user is authenticated
        if ($user) {
            $roleUser = $user->role_user;

            // Check if the user has the required role
            if (in_array($roleUser, $role)) {
                return $next($request);
            }

            // Redirect based on the user's role
            return redirect()->route(ControllersRole::redirectBasedOnRole($roleUser));
        }

        // If the user is not authenticated and not accessing the login route,
        // you can handle it accordingly, for example, redirect to the login page.
        return redirect()->route('user.laporkanInsiden');
    }
}
