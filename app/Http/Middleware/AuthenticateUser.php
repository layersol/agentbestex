<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login'); // redirect if not logged in
        }

        return $next($request); // continue if authenticated
    }
}
