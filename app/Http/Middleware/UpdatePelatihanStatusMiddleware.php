<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\PelatihanDanBimbingan;
use App\Models\Tempat;
use Carbon\Carbon;

class UpdatePelatihanStatusMiddleware
{
    public function handle($request, Closure $next)
    {
        // Abaikan middleware jika rute adalah 'akhiriPelatihan'
        if ($request->route()?->getName() === 'pelatihandanbimbingan.akhiriPelatihan') {
            return $next($request);
        }

        $now = Carbon::now();

        // Perbarui status pelatihan
        PelatihanDanBimbingan::where('status', '!=', 'selesai') // Hanya periksa pelatihan yang belum selesai
            ->get()
            ->each(function ($pelatihan) use ($now) {
                $tanggal = Carbon::parse($pelatihan->tanggal);
                $waktuMulai = Carbon::parse($pelatihan->tanggal . ' ' . $pelatihan->waktu_mulai);
                $waktuSelesai = $pelatihan->waktu_selesai 
                    ? Carbon::parse($pelatihan->tanggal . ' ' . $pelatihan->waktu_selesai) 
                    : null;

                if ($tanggal->isToday()) {
                    if ($now->greaterThanOrEqualTo($waktuMulai) && (!$waktuSelesai || $now->lessThan($waktuSelesai))) {
                        // Status 'berlangsung' jika sudah melewati waktu mulai tetapi belum melewati waktu selesai (atau waktu selesai tidak ada)
                        $pelatihan->update(['status' => 'berlangsung']);

                        session()->push('notifications', [
                            'message' => 'success, Pelatihan sedang berlangsung.',
                            'timestamp' => now()->toDateTimeString(),
                        ]);
                    } elseif ($waktuSelesai && $now->greaterThanOrEqualTo($waktuSelesai)) {
                        // Status 'selesai' hanya jika waktu selesai ada dan sudah lewat
                        $pelatihan->update(['status' => 'selesai']);

                        // Update status tempat menjadi tersedia
                        $tempat = Tempat::find($pelatihan->tempat_id);
                        if ($tempat) {
                            $tempat->update(['status' => 'tersedia']);

                            session()->push('notifications', [
                                'message' => 'success, Pelatihan telah selesai dan tempat kembali ke status tersedia.',
                                'timestamp' => now()->toDateTimeString(),
                            ]);
                        }
                    } elseif ($now->lessThan($waktuMulai)) {
                        $pelatihan->update(['status' => 'akanhadir']);

                        session()->push('notifications', [
                            'message' => 'info, Pelatihan akan segera dimulai.',
                            'timestamp' => now()->toDateTimeString(),
                        ]);
                    }
                } elseif ($tanggal->isFuture()) {
                    $pelatihan->update(['status' => 'akanhadir']);

                    session()->push('notifications', [
                        'message' => 'info, Pelatihan dijadwalkan untuk masa mendatang.',
                        'timestamp' => now()->toDateTimeString(),
                    ]);
                } else {
                    $pelatihan->update(['status' => 'selesai']);

                    // Update status tempat menjadi tersedia
                    $tempat = Tempat::find($pelatihan->tempat_id);
                    if ($tempat) {
                        $tempat->update(['status' => 'tersedia']);

                        session()->push('notifications', [
                            'message' => 'success, Pelatihan telah selesai dan tempat kembali ke status tersedia.',
                            'timestamp' => now()->toDateTimeString(),
                        ]);
                    }
                }
            });

        return $next($request);
    }
}
