<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TrackActiveUsers
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $userId = Auth::id();

            // Simpan status aktif ke sesi
            Session::put('user-is-online-' . $userId, true);

            // Opsi: Setel waktu kadaluwarsa sesi untuk menandai tidak aktif setelah waktu tertentu
            $expireAfter = 60; // dalam menit
            Session::put('last-active-time-' . $userId, now()->timestamp);

            // Hapus sesi jika sudah kedaluwarsa
            $inactiveTime = now()->timestamp - Session::get('last-active-time-' . $userId, now()->timestamp);
            if ($inactiveTime > ($expireAfter * 60)) {
                Session::forget('user-is-online-' . $userId);
            }
        }

        return $next($request);
    }
}
