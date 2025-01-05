<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfSessionExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah sesi `user_group` tersedia
        if ($request->session()->has('user_group')) {
            $group = $request->session()->get('user_group');

            // Redirect ke dashboard sesuai grup
            if ($group === 'SuperAdmin') {
                return redirect()->route('dashboard.superadmin');
            } elseif ($group === 'Umum') {
                return redirect()->route('dashboard.umum');
            } else {
                return redirect()->route('dashboard.bidang');
            }
        }

        // Jika tidak ada sesi, lanjutkan permintaan
        return $next($request);
    }
}
