<?php

namespace App\Http\Controllers;

use App\Models\PelatihanDanBimbingan;
use App\Models\User;
use App\Models\Group;
use App\Models\Tempat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PelatihanDanBimbinganController extends Controller
{
    public function index()
    {
        try {
            $userGroup = Auth::user()->group->name; // Grup user yang sedang login
            $userId = Auth::id(); // ID user yang sedang login
        
            // Ambil data Pelatihan dan Bimbingan sesuai aturan
            if ($userGroup === 'SuperAdmin' || $userGroup === 'Umum') {
                // Jika grup user adalah SuperAdmin atau Umum, tampilkan semua data
                $pelatihanDanBimbingan = PelatihanDanBimbingan::with(['user', 'group', 'tempat', 'createdBy', 'updatedBy'])->get();
            } else {
                // Jika grup user lainnya, filter berdasarkan group dan created_id
                $allowedGroups = ['E-Government', 'ITIK', 'Persandian', 'PIKP', 'Statistik', 'Sekretariat'];
                if (in_array($userGroup, $allowedGroups)) {
                    $pelatihanDanBimbingan = PelatihanDanBimbingan::with(['user', 'group', 'tempat', 'createdBy', 'updatedBy'])
                        ->whereHas('createdBy.group', function ($query) use ($userGroup) {
                            $query->where('name', $userGroup); // Filter berdasarkan grup user
                        })
                        ->where('created_id', $userId) // Filter berdasarkan user ID
                        ->get();
                } else {
                    // Jika grup tidak sesuai, tampilkan data kosong
                    $pelatihanDanBimbingan = collect([]);
                }
            }
    
            // Ambil data pelatihan yang dibuat oleh user yang login
            if ($userGroup !== 'SuperAdmin' && $userGroup !== 'Umum') {
                // Hitung jumlah pelatihan yang dibuat oleh user
                $pelatihanKu = PelatihanDanBimbingan::where('created_id', $userId)->count();
            } else {
                $pelatihanKu = 0; // Jika SuperAdmin atau Umum, tidak tampilkan jumlah pelatihan
            }

            // Hitung jumlah pelatihan yang dibuat oleh grup selain SuperAdmin dan Umum
            $allowedGroups = ['E-Government', 'ITIK', 'Persandian', 'PIKP', 'Statistik', 'Sekretariat'];

            $pelatihanByBidang = PelatihanDanBimbingan::whereHas('createdBy.group', function ($query) use ($allowedGroups) {
                $query->whereIn('name', $allowedGroups);
            })->count();
        
         
    
            // Tambahkan data sisa kuota
            $pelatihanDanBimbingan->transform(function ($pelatihan) {
                $jumlahPeserta = $pelatihan->peserta ? count(explode(', ', $pelatihan->peserta)) : 0;
                $pelatihan->sisa_kuota = $pelatihan->kuota - $jumlahPeserta;
                return $pelatihan;
            });
    
            // Hitung total pelatihan
            $totalPelatihan = PelatihanDanBimbingan::count();
    
            // Hitung pelatihan berdasarkan status
            $pelatihanAkanhadir= PelatihanDanBimbingan::where('status', 'akanhadir')->count();
            $pelatihanBerlangsung = PelatihanDanBimbingan::where('status', 'berlangsung')->count();
            $pelatihanSelesai = PelatihanDanBimbingan::where('status', 'selesai')->count();
    
            // Hitung total peserta
            $totalPeserta = PelatihanDanBimbingan::all()
                ->reduce(function ($carry, $pelatihan) {
                    $peserta = $pelatihan->peserta ? explode(', ', $pelatihan->peserta) : [];
                    return $carry + count($peserta);
                }, 0);
    
            // Return view dengan data yang sudah diproses
            return view('pelatihandanbimbingan.index', compact(
                'pelatihanDanBimbingan',
                'totalPelatihan',
                'pelatihanAkanhadir',
                'pelatihanBerlangsung',
                'pelatihanSelesai',
                'totalPeserta',
                'pelatihanKu',  
                'pelatihanByBidang'
            ));
    
        } catch (\Exception $e) {
            // Error notification
            session()->push('notifications', [
                'message' => 'error, Gagal memuat data Pelatihan dan Bimbingan. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->back();
        }
    }
    
    


    public function show($id)
    {
        // Ambil data pelatihan dan bimbingan beserta relasi terkait
        $pelatihan = PelatihanDanBimbingan::with(['user', 'group', 'tempat'])->findOrFail($id);
    
        // Tampilkan view dengan detail pelatihan dan status yang diperbarui
        return view('pelatihandanbimbingan.show', compact('pelatihan'));
    }
    
    


    public function tambahPeserta(Request $request, $id)
    {
        try {
            $pelatihan = PelatihanDanBimbingan::findOrFail($id);
    
            // Ambil nama user saat ini
            $userName = auth()->user()->name;
    
            // Ambil daftar peserta yang ada
            $existingPeserta = $pelatihan->peserta ? array_map('trim', explode(', ', $pelatihan->peserta)) : [];
    
            // Periksa apakah kuota penuh
            if (count($existingPeserta) >= $pelatihan->kuota) {
                session()->push('notifications', [
                    'message' => 'error, Kuota pelatihan telah penuh.',
                    'timestamp' => now()->toDateTimeString(),
                ]);
    
                return redirect()->back();
            }
    
            // Tambahkan nama user jika belum ada
            if (!in_array($userName, $existingPeserta)) {
                $existingPeserta[] = $userName;
                $pelatihan->peserta = implode(', ', $existingPeserta);
                $pelatihan->save();
    
                session()->push('notifications', [
                    'message' => 'success, Anda berhasil mengikuti pelatihan.',
                    'timestamp' => now()->toDateTimeString(),
                ]);
            } else {
                session()->push('notifications', [
                    'message' => 'error, Anda sudah terdaftar dalam pelatihan ini.',
                    'timestamp' => now()->toDateTimeString(),
                ]);
            }
    
            return redirect()->back();
        } catch (\Exception $e) {
            session()->push('notifications', [
                'message' => 'error, Gagal mengikuti pelatihan. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->back();
        }
    }    
    
    

    // Fungsi untuk mengakhiri pelatihan dan mengembalikan status tempat
    public function akhiriPelatihan($id)
    {
        try {
            $pelatihan = PelatihanDanBimbingan::findOrFail($id);
    
            // Jika waktu_selesai kosong, isi dengan waktu sekarang
            if (empty($pelatihan->waktu_selesai)) {
                $pelatihan->waktu_selesai = now()->format('H:i');
            }
    
            // Update status pelatihan menjadi selesai
            $pelatihan->update([
                'status' => 'selesai',
                'waktu_selesai' => $pelatihan->waktu_selesai
            ]);
    
            // Update status tempat menjadi tersedia
            $tempat = Tempat::find($pelatihan->tempat_id);
            $tempat->update(['status' => 'tersedia']);
    
            session()->push('notifications', [
                'message' => 'success, Pelatihan telah selesai dan tempat kembali ke status tersedia.',
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('pelatihandanbimbingan.show', $id);
        } catch (\Exception $e) {
            session()->push('notifications', [
                'message' => 'error, Gagal mengakhiri pelatihan. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('pelatihandanbimbingan.show', $id);
        }
    }
    

    public function create()
    {
        // Get users excluding SuperAdmin and Umum groups
        $users = User::whereDoesntHave('groups', function ($query) {
            $query->whereIn('name', ['SuperAdmin', 'Umum']);
        })->get();

        // Get groups excluding SuperAdmin and Umum
        $groups = Group::whereNotIn('name', ['SuperAdmin', 'Umum'])->get();

        // Get available places (status = 'tersedia')
        $tempats = Tempat::where('status', 'tersedia')->get();

        return view('pelatihandanbimbingan.create', compact('users', 'groups', 'tempats'));
    }

    public function store(Request $request)
    {
        try {
            // Generate no_pelatihan using the format -<timestamp>
            $no_pelatihan = 'Pltdkis - ' . time();
            
            $validated = $request->validate([
                'nama_pelatihan' => 'required|string|max:50',
                'user_id' => 'required|exists:users,id',
                'group_id' => 'required|exists:groups,id',
                'tempat_id' => 'required|exists:tempat,id',
                'tanggal' => 'required|date',
                'waktu_mulai' => 'nullable|date_format:H:i',
                'waktu_selesai' => 'nullable|date_format:H:i|after:waktu_mulai',
                'kuota' => 'required|integer|min:1',
            ]);
    
            // Set waktu_mulai to current time if not provided
            if (!$request->filled('waktu_mulai')) {
                $validated['waktu_mulai'] = now()->format('H:i');
            }
    
            // Update status berdasarkan tanggal, waktu_mulai, dan waktu_selesai
            $tanggal = Carbon::parse($validated['tanggal']);
            $waktuMulai = Carbon::parse($validated['tanggal'] . ' ' . $validated['waktu_mulai']);
            $waktuSelesai = $validated['waktu_selesai'] 
                ? Carbon::parse($validated['tanggal'] . ' ' . $validated['waktu_selesai'])
                : null;
    
            $now = now();
    
            if ($tanggal->isToday()) {
                if ($now->greaterThanOrEqualTo($waktuMulai) && (!$waktuSelesai || $now->lessThan($waktuSelesai))) {
                    $validated['status'] = 'berlangsung';
                } elseif ($now->lessThan($waktuMulai)) {
                    $validated['status'] = 'akanhadir';
                } elseif ($waktuSelesai && $now->greaterThanOrEqualTo($waktuSelesai)) {
                    $validated['status'] = 'selesai';
                }
            } elseif ($tanggal->isFuture()) {
                $validated['status'] = 'akanhadir';
            } else {
                $validated['status'] = 'selesai';
            }
    
            // Add additional fields
            $validated['no_pelatihan'] = $no_pelatihan;
    
            // Create the new PelatihanDanBimbingan
            PelatihanDanBimbingan::create($validated);
    
            // Update the tempat status to 'sedang digunakan'
            $tempat = Tempat::find($request->tempat_id);
            $tempat->update(['status' => 'sedang digunakan']);
    
            // Success notification
            session()->push('notifications', [
                'message' => 'success, Pelatihan dan bimbingan berhasil ditambahkan.',
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('pelatihandanbimbingan.index');
        } catch (\Exception $e) {
            // Error notification
            session()->push('notifications', [
                'message' => 'error, Pelatihan dan bimbingan gagal ditambahkan. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('pelatihandanbimbingan.create');
        }
    }
    
    
    

    public function edit($id)
    {
        // Fetch PelatihanDanBimbingan by ID
        $pelatihan = PelatihanDanBimbingan::findOrFail($id);

        // Get users excluding SuperAdmin and Umum groups
        $users = User::whereDoesntHave('groups', function ($query) {
            $query->whereIn('name', ['SuperAdmin', 'Umum']);
        })->get();

        // Get groups excluding SuperAdmin and Umum
        $groups = Group::whereNotIn('name', ['SuperAdmin', 'Umum'])->get();

        // Get available places (status = 'tersedia')
        $tempats = Tempat::where('status', 'tersedia')->orWhere('id', $pelatihan->tempat_id)->get();

        return view('pelatihandanbimbingan.edit', compact('pelatihan', 'users', 'groups', 'tempats'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'no_pelatihan' => 'required|string|max:50',
                'nama_pelatihan' => 'required|string|max:50',
                'user_id' => 'required|exists:users,id',
                'group_id' => 'required|exists:groups,id',
                'tempat_id' => 'required|exists:tempat,id',
                'tanggal' => 'required|date',
                'waktu_mulai' => 'nullable|date_format:H:i',
                'waktu_selesai' => 'nullable|date_format:H:i|after:waktu_mulai',
                'kuota' => 'required|integer|min:1',
            ]);
    
            $pelatihan = PelatihanDanBimbingan::findOrFail($id);
    
            // Tangani waktu mulai dan selesai
            $validated['waktu_mulai'] = $request->filled('waktu_mulai') 
                ? $request->waktu_mulai 
                : $pelatihan->waktu_mulai;
    
            $validated['waktu_selesai'] = $request->filled('waktu_selesai') 
                ? $request->waktu_selesai 
                : $pelatihan->waktu_selesai;
    
            // Update status berdasarkan tanggal, waktu_mulai, dan waktu_selesai
            $tanggal = Carbon::parse($validated['tanggal']);
            $waktuMulai = Carbon::parse($validated['tanggal'] . ' ' . $validated['waktu_mulai']);
            $waktuSelesai = $validated['waktu_selesai'] 
                ? Carbon::parse($validated['tanggal'] . ' ' . $validated['waktu_selesai'])
                : null;
    
            $now = now();
    
            if ($tanggal->isToday()) {
                if ($now->greaterThanOrEqualTo($waktuMulai) && (!$waktuSelesai || $now->lessThan($waktuSelesai))) {
                    $validated['status'] = 'berlangsung';
                } elseif ($now->lessThan($waktuMulai)) {
                    $validated['status'] = 'akanhadir';
                } elseif ($waktuSelesai && $now->greaterThanOrEqualTo($waktuSelesai)) {
                    $validated['status'] = 'selesai';
                }
            } elseif ($tanggal->isFuture()) {
                $validated['status'] = 'akanhadir';
            } else {
                $validated['status'] = 'selesai';
            }
    
            $pelatihan->update($validated);
            
    
            session()->push('notifications', [
                'message' => 'success, Pelatihan dan bimbingan berhasil diperbarui.',
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('pelatihandanbimbingan.index');
        } catch (\Exception $e) {
            session()->push('notifications', [
                'message' => 'error, Pelatihan dan bimbingan gagal diperbarui. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('pelatihandanbimbingan.edit', $id);
        }
    }
    
    
    
    
    

    public function destroy($id)
    {
        try {
            $pelatihan = PelatihanDanBimbingan::findOrFail($id);
            $pelatihan->delete();

            // Update the tempat status to 'tersedia' after deletion
            $tempat = Tempat::find($pelatihan->tempat_id);
            $tempat->update(['status' => 'tersedia']);

            // Success notification
            session()->push('notifications', [
                'message' => 'success, Pelatihan dan bimbingan berhasil dihapus.',
                'timestamp' => now()->toDateTimeString(),
            ]);

            return redirect()->route('pelatihandanbimbingan.index');
        } catch (\Exception $e) {
            // Error notification
            session()->push('notifications', [
                'message' => 'error, Pelatihan dan bimbingan gagal dihapus. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);

            return redirect()->route('pelatihandanbimbingan.index');
        }
    }
    



}
