<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isNoAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return redirect('/dashboard')->with('message', 'anda sudah login');
        } elseif (Auth::check() && Auth::user()->is_admin == 0) {
            return redirect('/dashboard/user')->with('message', 'anda sudah login');
        } else {
            return $next($request);
        }
    }
}
