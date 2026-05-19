<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (!in_array(Auth::user()->role, $roles)) {
            // Jika role tidak sesuai, redirect ke halamannya masing-masing
            if (Auth::user()->role === 'kasir') {
                return redirect('/kasir');
            } elseif (Auth::user()->role === 'kitchen') {
                return redirect('/kitchen');
            }
            
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
