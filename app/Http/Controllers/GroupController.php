<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        try {
            $groups = Group::all(); // Mengambil semua data grup
            return view('groups.index', compact('groups')); // Menampilkan view 'groups.index'
        } catch (\Exception $e) {
            // Menambahkan notifikasi error ke session
            session()->push('notifications', [
                'message' => 'error, Gagal memuat grup. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString()
            ]);
            return redirect()->route('groups.index');
        }
    }
    
    
    public function showLandingPage()
    {
        $groups = Group::all(); // Ambil semua grup dari database
        return view('landing_page', compact('groups'));
    }

    public function create()
    {
        return view('groups.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:groups|max:255',
                'tugas' => 'nullable|string|max:255',
            ]);

            Group::create([
                'name' => $request->name,
                'tugas' => $request->tugas,
            ]);

            // Menambahkan notifikasi sukses ke session
            session()->push('notifications', [
                'message' => 'success, Grup berhasil ditambahkan.',
                'timestamp' => now()->toDateTimeString()
            ]);
            return redirect()->route('groups.index');
        } catch (\Exception $e) {
            // Menambahkan notifikasi error ke session
            session()->push('notifications', [
                'message' => 'error, Grup gagal ditambahkan. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString()
            ]);
            return redirect()->route('groups.create')->withInput();
        }
    }

    public function show(Group $group)
    {
        return view('groups.show', compact('group'));
    }

    public function edit(Group $group)
    {
        return view('groups.edit', compact('group'));
    }

    public function update(Request $request, Group $group)
    {
        try {
            $request->validate([
                'name' => 'required|unique:groups,name,' . $group->id . '|max:255',
            ]);

            $group->update([
                'name' => $request->name,
                'tugas' => $request->tugas,
            ]);

            // Menambahkan notifikasi sukses ke session
            session()->push('notifications', [
                'message' => 'success, Grup berhasil diperbarui.',
                'timestamp' => now()->toDateTimeString()
            ]);
            return redirect()->route('groups.index');
        } catch (\Exception $e) {
            // Menambahkan notifikasi error ke session
            session()->push('notifications', [
                'message' => 'error, Grup gagal diperbarui. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString()
            ]);
            return redirect()->route('groups.edit')->withInput();
        }
    }

    public function destroy(Group $group)
    {
        try {
            $group->delete();

            // Menambahkan notifikasi sukses ke session
            session()->push('notifications', [
                'message' => 'success, Grup berhasil dihapus.',
                'timestamp' => now()->toDateTimeString()
            ]);
            return redirect()->route('groups.index');
        } catch (\Exception $e) {
            // Menambahkan notifikasi error ke session
            session()->push('notifications', [
                'message' => 'error, Grup gagal dihapus. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString()
            ]);
            return redirect()->route('groups.index');
        }
    }

    
}
