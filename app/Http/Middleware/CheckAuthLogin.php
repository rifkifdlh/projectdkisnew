<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAuthLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            // Jika belum login, redirect ke halaman landing_page
            return redirect()->route('landing_page');
        }

        // Jika sudah login, lanjutkan request
        return $next($request);
    }
}
