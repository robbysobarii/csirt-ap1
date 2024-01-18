<?php

namespace App\Http\Middleware;

use App\Http\Controllers\RoleController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure  $next
     * @param  string  ...$role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        // Check if the requested route is the login route
        if ($request->routeIs('login')) {
            // Allow access to the login route
            return $next($request);
        }

        // Check if the user is authenticated
        if (auth()->check()) {
            $roleUser = auth()->user()->role_user;

            // Check if the user has the required role
            if (in_array($roleUser, $role)) {
                return $next($request);
            }

            // Redirect based on the user's role
            return redirect()->route(RoleController::redirectBasedOnRole($roleUser));
        }

        // If the user is not authenticated and not accessing the login route,
        // you can handle it accordingly, for example, redirect to the login page.
        return redirect()->route('login');
    }
}
