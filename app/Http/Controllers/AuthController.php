<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Group;
use App\Models\UserGroup;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function index()
    {
        $users = User::all(); // Ambil semua pengguna
        return view('users.index', compact('users')); // Kirim data ke view
    }
    


    // Tampilkan halaman login
    public function showLogin(Request $request)
    {
        $groups = collect();

        if ($request->filled('nip')) {
            // Validasi bahwa NIP adalah angka dan panjangnya sesuai
            $request->validate(['nip' => 'numeric|min:8']);

            $userGroups = User::where('nip', $request->nip)->with('group')->get();
            $groups = $userGroups->pluck('group')->unique();
        }

        return view('auth.login', compact('groups'));
    }


    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'nip' => 'required',
            'password' => 'required',
            'group_id' => 'required|exists:groups,id',
        ]);
    
        // Cari pengguna berdasarkan NIP dan grup yang dipilih
        $user = User::where('nip', $request->nip)
                    ->where('group_id', $request->group_id)
                    ->first();
    
        if (!$user) {
            return back()->withErrors(['login_failed' => 'Pengguna dengan NIP dan grup ini tidak ditemukan!']);
        }
    
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login_failed' => 'Password salah!']);
        }
    
        // Login pengguna
        Auth::login($user);
    
        // Simpan grup di sesi
        $request->session()->put('user_group', $user->group->name);
    
        // Tandai pengguna sebagai online di sesi
        session(['user-is-online-' . Auth::id() => true]);
    
        // Clear existing notifications in the session to reset them
        session()->forget('notifications');
    
        // Tambahkan notifikasi ke session
        session()->push('notifications', [
            'message' => 'Hi ' . $user->name .', login berhasil.',
            'timestamp' => now()->toDateTimeString()
        ]);
    
        // 🔥 Tambahkan Session Flash untuk login sukses
        session()->flash('login_success', 'Selamat datang, ' . $user->name . '! Anda berhasil login.');
    
        // Redirect sesuai dengan group_id
        if ($user->group->name === 'SuperAdmin') {
            return redirect()->route('dashboard.superadmin');
        } elseif ($user->group->name === 'Umum') {
            return redirect()->route('dashboard.umum');
        } elseif (in_array($user->group->name, ['E-Government', 'ITIK', 'Persandian', 'PIKP', 'Statistik', 'Sekretariat'])) {
            return redirect()->route('dashboard.bidang');
        }
    }
    

    
    
    


    // Tampilkan halaman register
    public function showRegister()
    {
        // Set group_id to 8 for 'Umum' group
        $groupId = 8;
    
        return view('auth.register', compact('groupId')); // Pass the group ID to the view
    }
    

 // Proses register
 public function register(Request $request)
 {
     // Validasi input
     $request->validate([
         'name' => 'required|string|max:255',
         'nip' => 'required|unique:users,nip',
         'password' => 'required|min:8|confirmed',
         'group_id' => 'required|in:8',
         'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
     ]);
 
     // Handle file upload jika foto disertakan
     $photoPath = null;
     if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
         $photoExtension = $request->photo->getClientOriginalExtension();
         $photoName = time() . '_profil_' . Str::random(8) . '.' . $photoExtension;
         $request->photo->move(public_path('assets/img/profil'), $photoName);
         $photoPath = $photoName;
     }
 
     try {
         // Buat pengguna baru
         $user = User::create([
             'name' => $request->name,
             'nip' => $request->nip,
             'password' => Hash::make($request->password),
             'group_id' => 8,
             'photo' => $photoPath,
         ]);
 
         // Tambahkan ke user_groups jika belum ada
         $existingUserGroup = UserGroup::where('user_id', $user->id)->where('group_id', 8)->first();
 
         if (!$existingUserGroup) {
             UserGroup::create([
                 'user_id' => $user->id,
                 'group_id' => 8,
             ]);
         }
 
         // Tambahkan session sukses
         session()->flash('register_success', 'Registrasi berhasil. Silakan login.');
         
         // Redirect ke halaman yang sama dan menambahkan data untuk membuka modal
         return redirect()->route('landing_page')->with('openLoginModal', true);
 
     } catch (\Exception $e) {
         // Tambahkan session gagal
         session()->flash('register_failed', 'Registrasi gagal. Silakan coba lagi.');
         return back()->withErrors(['register_failed' => 'Terjadi kesalahan saat registrasi.'])
                      ->with('openRegisterModal', true);  // Passing the session to open the register modal
     }
 }
 
 
 
    
    

    // Fungsi untuk menghitung jumlah pengguna yang sedang online
    public function countOnlineUsers()
    {
        $onlineUsers = 0;
    
        // Cek sesi aktif di database atau array session
        foreach (User::all() as $user) {
            if (session()->has('user-online-' . $user->id)) {
                $onlineUsers++;
            }
        }
    
        return response()->json([
            'status' => 'success',
            'online_users' => $onlineUsers
        ]);
    }
    



    // Logout
    public function logout(Request $request)
    {
        // Hapus sesi `user_group`
        $request->session()->forget('user_group');
        session()->forget('user-is-online-' . Auth::id());
        // Logout pengguna
        Auth::logout();
    
        // Redirect ke halaman landing
        return redirect()->route('landing_page');
    }
    



}

