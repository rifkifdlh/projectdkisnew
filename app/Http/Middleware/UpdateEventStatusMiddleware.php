<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Event;
use App\Models\Tempat;
use Carbon\Carbon;

class UpdateEventStatusMiddleware
{
    public function handle($request, Closure $next)
    {
        $now = Carbon::now();

        // Perbarui status event
        Event::where('status', '!=', 'selesai') // Hanya periksa event yang belum selesai
            ->get()
            ->each(function ($event) use ($now) {
                $tanggal = Carbon::parse($event->tanggal);
                $waktuMulai = Carbon::parse($event->tanggal . ' ' . $event->waktu_mulai);
                $waktuSelesai = $event->waktu_selesai 
                    ? Carbon::parse($event->tanggal . ' ' . $event->waktu_selesai) 
                    : null;

                if ($tanggal->isToday()) {
                    if ($now->greaterThanOrEqualTo($waktuMulai) && (!$waktuSelesai || $now->lessThan($waktuSelesai))) {
                        $event->update(['status' => 'berlangsung']);
                    } elseif ($waktuSelesai && $now->greaterThanOrEqualTo($waktuSelesai)) {
                        $event->update(['status' => 'selesai']);

                        // Update status tempat menjadi tersedia
                        $tempat = Tempat::find($event->tempat_id);
                        if ($tempat) {
                            $tempat->update(['status' => 'tersedia']);
                        }
                    } elseif ($now->lessThan($waktuMulai)) {
                        $event->update(['status' => 'akanhadir']);
                    }
                } elseif ($tanggal->isFuture()) {
                    $event->update(['status' => 'akanhadir']);
                } else {
                    $event->update(['status' => 'selesai']);

                    // Update status tempat menjadi tersedia
                    $tempat = Tempat::find($event->tempat_id);
                    if ($tempat) {
                        $tempat->update(['status' => 'tersedia']);
                    }
                }
            });

        return $next($request);
    }
}
