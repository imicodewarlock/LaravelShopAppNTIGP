<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        if (!Session::has('user')) {
            # code...
            return redirect()->route('auth.login.show');
        }

        $user = Session::get('user');

        if (!in_array($user['role'], $role)) {
            # code...
            return redirect()->route('auth.unauthorized');
        }

        return $next($request);
    }
}
