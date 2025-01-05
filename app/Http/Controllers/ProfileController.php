<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Group;



class ProfileController extends Controller
{
    

    // Tampilkan halaman profil
    public function showProfile($nip)
    {
        // Ambil data pengguna berdasarkan NIP
        $user = User::where('nip', $nip)->firstOrFail();
        
        // Ambil grup terkait dengan pengguna berdasarkan NIP
        $groups = Group::whereIn('id', User::where('nip', $nip)->pluck('group_id'))->get();
        
        // Kembalikan tampilan profil dengan data pengguna dan grup
        return view('profile.show', compact('user', 'groups'));
    }

    // Menampilkan halaman edit profil berdasarkan NIP
    public function showEditProfile($nip)
    {
        $user = User::where('nip', $nip)->firstOrFail(); // Menampilkan data berdasarkan NIP
        return view('profile.edit', compact('user')); // Pastikan file blade adalah `profile/edit.blade.php`
    }

    // Proses edit profil berdasarkan NIP
    public function updateProfile(Request $request, $nip)
    {
        $user = User::where('nip', $nip)->firstOrFail(); // Ambil data berdasarkan NIP
    
        try {
            // Validasi input
            $request->validate([
                'name' => 'required|string|max:255',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'password' => 'nullable|min:6|confirmed',
            ]);
    
            // Handle file upload jika ada foto baru
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $photoExtension = $request->photo->getClientOriginalExtension();
                $photoName = time() . '_' . Str::random(8) . '.' . $photoExtension;
                $request->photo->move(public_path('assets/img/profil'), $photoName);
    
                // Hapus foto lama jika ada
                if ($user->photo) {
                    $oldPhotoPath = public_path('assets/img/profil/' . $user->photo);
                    if (file_exists($oldPhotoPath)) {
                        unlink($oldPhotoPath);
                    }
                }
    
                $user->photo = $photoName;
            }
    
            // Update nama pengguna
            $user->name = $request->name;
    
            // Perbarui password jika diisi
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
    
                // Notifikasi sukses khusus untuk password
                session()->push('notifications', [
                    'message' => 'success, Password berhasil diperbarui.',
                    'timestamp' => now()->toDateTimeString(),
                ]);
            }
    
            $user->save();
    
            // Notifikasi umum sukses
            session()->push('notifications', [
                'message' => 'success, Profil berhasil diperbarui.',
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('profile.show', ['nip' => $user->nip]);
        } catch (\Exception $e) {
            // Notifikasi error
            session()->push('notifications', [
                'message' => 'error, Profil gagal diperbarui. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            // Jika password gagal diperbarui
            if ($request->filled('password')) {
                session()->push('notifications', [
                    'message' => 'error, Password gagal diperbarui.',
                    'timestamp' => now()->toDateTimeString(),
                ]);
            }
    
            return redirect()->route('profile.edit', ['nip' => $user->nip])->withInput();
        }
    }
    
    
}
