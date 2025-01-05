<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function index()
    {
        // Ambil semua data user dengan group
        $users = User::with('group')->get();

        // Total user
        $userCount = User::count();

        // Hitung users di 'SuperAdmin' group
        $superadminCount = Group::where('name', 'SuperAdmin')->first()?->users()->count() ?? 0;

        // Hitung users di groups lain selain 'SuperAdmin' dan 'Umum'
        $bidangCount = User::whereHas('group', function ($query) {
            $query->whereNotIn('name', ['SuperAdmin', 'Umum']);
        })->count();

        // Hitung users di 'Umum' group
        $umumCount = Group::where('name', 'Umum')->first()?->users()->count() ?? 0;

        // Ambil semua data user_groups dengan relasi
        $userGroups = UserGroup::with(['user', 'group', 'createdBy', 'updatedBy'])->get();

        // Ambil data users yang tidak ada di user_groups
        $usersWithoutGroups = User::doesntHave('userGroups')->with('group')->get();

        // Gabungkan kedua data
        $allUsers = collect();

        foreach ($userGroups as $userGroup) {
            $allUsers->push([
                'group_id' => $userGroup->group_id,
                'group_name' => $userGroup->group->name ?? 'No Group',
                'user_name' => $userGroup->user->name,
                'created_by' => $userGroup->createdBy->name ?? 'Unknown',
                'updated_by' => $userGroup->updatedBy->name ?? 'Unknown',
            ]);
        }

        foreach ($usersWithoutGroups as $user) {
            $allUsers->push([
                'group_id' => $user->group_id ?? 'N/A',
                'group_name' => $user->group->name ?? 'No Group',
                'user_name' => $user->name,
                'created_by' => 'N/A',
                'updated_by' => 'N/A',
            ]);
        }

        // Kelompokkan data berdasarkan group_id
        $groupedUsers = $allUsers->groupBy('group_id');

        return view('users.index', compact('userCount', 'superadminCount', 'bidangCount', 'umumCount', 'users', 'groupedUsers'));
    }

    public function create()
    {
        $groups = Group::all(); // Ambil semua grup
        return view('users.create', compact('groups'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'nip' => 'required|unique:users,nip,NULL,id,group_id,' . $request->group_id,
                'password' => 'required|string|min:6',
                'group_id' => 'required|exists:groups,id',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            $photoPath = null;
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $photoExtension = $request->photo->getClientOriginalExtension();
                $photoName = time() . '_profil_' . Str::random(8) . '.' . $photoExtension;
                $request->photo->move(public_path('assets/img/profil'), $photoName);
                $photoPath = $photoName;
            }
    
            $user = User::create([
                'name' => $request->name,
                'nip' => $request->nip,
                'password' => Hash::make($request->password),
                'group_id' => $request->group_id,
                'photo' => $photoPath,
            ]);
    
            $user->userGroups()->create([
                'group_id' => $request->group_id,
                'created_id' => auth()->id(),
                'updated_id' => auth()->id(),
            ]);
    
            session()->push('notifications', [
                'message' => 'success, User berhasil ditambahkan.',
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            session()->push('notifications', [
                'message' => 'error, User gagal ditambahkan. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('users.create')->withInput();
        }
    }
    

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $groups = Group::all(); // Ambil semua grup
        return view('users.edit', compact('user', 'groups'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
    
            // Validasi input
            $request->validate([
                'name' => 'required|string|max:255',
                'nip' => 'required|unique:users,nip,' . $user->id . ',id,group_id,' . $request->group_id,
                'password' => 'nullable|string|min:6',
                'group_id' => 'required|exists:groups,id',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            // Proses foto jika diunggah
            $photoPath = $user->photo;
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $photoExtension = $request->photo->getClientOriginalExtension();
                $photoName = time() . '_profil_' . Str::random(8) . '.' . $photoExtension;
                $request->photo->move(public_path('assets/img/profil'), $photoName);
                $photoPath = $photoName;
            }
    
            $oldGroupId = $user->group_id;
    
            // Update data user
            $user->update([
                'name' => $request->name,
                'nip' => $request->nip,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
                'group_id' => $request->group_id,
                'photo' => $photoPath,
            ]);
    
            // Update entri user_groups
            $userGroup = UserGroup::where('user_id', $user->id)
                ->where('group_id', $oldGroupId)
                ->first();
    
            if ($userGroup) {
                if ($oldGroupId !== $request->group_id) {
                    // Hapus entri lama jika grup berubah
                    $userGroup->delete();
    
                    // Buat entri baru
                    $user->userGroups()->create([
                        'group_id' => $request->group_id,
                        'created_id' => $userGroup->created_id, // Tetap menggunakan `created_id` sebelumnya
                        'updated_id' => auth()->id(),
                    ]);
                } else {
                    // Hanya perbarui kolom `updated_id`
                    $userGroup->update([
                        'updated_id' => auth()->id(),
                    ]);
                }
            }
    
            session()->push('notifications', [
                'message' => 'success, User berhasil diperbarui.',
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            session()->push('notifications', [
                'message' => 'error, User gagal diperbarui. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('users.edit', $id)->withInput();
        }
    }
    
    
    

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
    
            $photoPath = $user->photo;
    
            if ($photoPath && $photoPath !== 'default.png' && file_exists(public_path('assets/img/profil/' . $photoPath))) {
                unlink(public_path('assets/img/profil/' . $photoPath));
            }
    
            $user->delete();
    
            session()->push('notifications', [
                'message' => 'success, User berhasil dihapus.',
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            session()->push('notifications', [
                'message' => 'error, User gagal dihapus. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('users.index');
        }
    }
    

    public function showProfile($nip)
    {
        $user = User::where('nip', $nip)->firstOrFail(); // Fetch user by NIP
        $groups = Group::whereIn('id', User::where('nip', $user->nip)->pluck('group_id'))->get(); // Fetch user groups

        return view('profile.show', compact('user', 'groups')); // Pass user and groups data to view
    }



}
