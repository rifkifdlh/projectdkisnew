<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\User;
use App\Models\Tempat;
use App\Models\PelatihanDanBimbingan;
use App\Models\Event;
use App\Models\AspirasiEvent;

use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function superadmin()
    {
        // Jumlah user terdaftar
        $jumlahUserTerdaftar = User::count();

        // Jumlah user online
        $usersOnline = 0;
        $allUsers = User::pluck('id');
        foreach ($allUsers as $userId) {
            if (Cache::has('user-is-online-' . $userId)) {
                $usersOnline++;
            }
        }

        // Jumlah groups
        $jumlahGroups = Group::count();
        // Jumlah tempat
        $jumlahTempat = Tempat::count();
        // Jumlah tempat digunakan
        $jumlahTempatDigunakan = Tempat::where('status', 'sedang digunakan')->count();
        // Jumlah pelatihan tersedia
        $jumlahPelatihanTersedia = PelatihanDanBimbingan::where('status', 'berlangsung')->count(); // Pelatihan yang sedang berlangsung
        //Jumlah event tersedia
        $jumlahEventTersedia = Event::where('status', 'berlangsung')->count(); // Pelatihan yang sedang berlangsung
        //Jumlah Aspirasi butuh peninjauan
        $aspirasiDitinjau = AspirasiEvent::where('status', 'ditinjau')->count();


        // Nama-nama grup yang termasuk "Bidang"
        $bidangGroups = ['E-Government', 'ITIK', 'Persandian', 'PIKP', 'Statistik', 'Sekretariat'];

        // Inisialisasi jumlah pengguna online per grup utama
        $onlineUsersByGroup = [
            'SuperAdmin' => 0,
            'Bidang' => 0,
            'Umum' => 0,
        ];

        // Hitung jumlah pengguna online berdasarkan grup utama
        $users = User::with('group')->get();
        foreach ($users as $user) {
            if (Cache::has('user-is-online-' . $user->id)) {
                if ($user->group->name === 'SuperAdmin') {
                    $onlineUsersByGroup['SuperAdmin']++;
                } elseif (in_array($user->group->name, $bidangGroups)) {
                    $onlineUsersByGroup['Bidang']++;
                } elseif ($user->group->name === 'Umum') {
                    $onlineUsersByGroup['Umum']++;
                }
            }
        }

        
        // Kirim variabel ke view
        return view('dashboard.superadmin', compact(
            'jumlahUserTerdaftar',
            'usersOnline',
            'jumlahGroups',
            'onlineUsersByGroup',
            'jumlahTempat',
            'jumlahTempatDigunakan',
            'jumlahPelatihanTersedia',
            'jumlahEventTersedia',
            'aspirasiDitinjau'
        ));
    }


    public function umum()
    {
        // Jumlah pelatihan yang tersedia dengan status akanhadir dan berlangsung
        $jumlahPelatihanTersedia = PelatihanDanBimbingan::whereIn('status', ['akanhadir', 'berlangsung'])->count();
    
        // Ambil nama pengguna login
        $namaUser = Auth::user()->name;
        $userId = Auth::id(); // ID user yang sedang login
    
        // Hitung jumlah pelatihan yang diikuti berdasarkan nama
        $jumlahPelatihan = PelatihanDanBimbingan::where('peserta', 'LIKE', '%' . $namaUser . '%')->count();
    
        // Hitung jumlah aspirasi yang diajukan oleh user login
        $jumlahAspirasiSaya = AspirasiEvent::where('created_id', $userId)->count();
    
        // Hitung jumlah aspirasi yang diterima oleh user login
        $jumlahAspirasiDisetujui = AspirasiEvent::where('created_id', $userId)
            ->where('status', 'disetujui')
            ->count();
    
        // Kirim data ke view dashboard.umum
        return view('dashboard.umum', compact(
            'jumlahPelatihanTersedia',
            'jumlahPelatihan',
            'jumlahAspirasiSaya',
            'jumlahAspirasiDisetujui'
        ));
    }
    
    

    public function bidang()
    {
        // Jumlah Aspirasi di tinjau
        $jumlahaspirasiDitinjau = AspirasiEvent::where('status', 'ditinjau')->count();
        $jumlahaspirasiDisetujui = AspirasiEvent::where('status', 'disetujui')->count();
        $jumlahaspirasiDitolak = AspirasiEvent::where('status', 'ditolak')->count();


        // Kirim variabel ke view
        return view('dashboard.bidang', compact(
            'jumlahaspirasiDitinjau',
            'jumlahaspirasiDisetujui',
            'jumlahaspirasiDitolak'
        ));

    }
    
}
