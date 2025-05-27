<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class IsAdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (Auth::check()) {
            if (!Auth::user()->is_admin) {
                throw new AccessDeniedHttpException('Anda tidak memiliki akses ke halaman ini');
                // return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini');
            }
        }

        return $next($request);
    }
}
