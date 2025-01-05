<?php

namespace App\Http\Controllers;

use App\Models\Tempat;
use Illuminate\Http\Request;

class TempatController extends Controller
{
    // Menampilkan daftar tempat
    public function index()
    {
        // Ambil semua data tempat dari database
        $tempats = Tempat::all();

        // Dapatkan jumlah tempat
        $tempatCount = Tempat::count();

        // Dapatkan jumlah tempat yang statusnya "digunakan"
        $tempatDigunakan = Tempat::where('status', 'sedang digunakan')->count();
        
        // Dapatkan jumlah tempat yang statusnya "tersedia"
        $tempatTersedia = Tempat::where('status', 'tersedia')->count();

        // Kirim data tempat dan jumlah tempat ke view
        return view('tempat.index', compact('tempats', 'tempatCount', 'tempatDigunakan', 'tempatTersedia'));
    }

    // Menampilkan form untuk menambah tempat
    public function create()
    {
        return view('tempat.create');
    }

    // Menyimpan data tempat baru
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:50',
                'alamat' => 'nullable|max:50',
                'status' => 'required|in:tersedia,sedang digunakan',
            ]);

            Tempat::create($request->all());

            session()->push('notifications', [
                'message' => 'success, Tempat berhasil ditambahkan.',
                'timestamp' => now()->toDateTimeString(),
            ]);

            return redirect()->route('tempat.index');
        } catch (\Exception $e) {
            session()->push('notifications', [
                'message' => 'error, Tempat gagal ditambahkan. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);

            return redirect()->route('tempat.index');
        }
    }

    // Menampilkan form untuk mengedit tempat
    public function edit($id)
    {
        $tempat = Tempat::findOrFail($id);
        return view('tempat.edit', compact('tempat'));
    }

    // Memperbarui data tempat
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|max:50',
                'alamat' => 'nullable|max:50',
                'status' => 'required|in:tersedia,sedang digunakan',
            ]);

            $tempat = Tempat::findOrFail($id);
            $tempat->update($request->all());

            session()->push('notifications', [
                'message' => 'success, Tempat berhasil diperbarui.',
                'timestamp' => now()->toDateTimeString(),
            ]);

            return redirect()->route('tempat.index');
        } catch (\Exception $e) {
            session()->push('notifications', [
                'message' => 'error, Tempat gagal diperbarui. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);

            return redirect()->route('tempat.index');
        }
    }

    // Menghapus data tempat
    public function destroy($id)
    {
        try {
            $tempat = Tempat::findOrFail($id);
            $tempat->delete();

            session()->push('notifications', [
                'message' => 'success, Tempat berhasil dihapus.',
                'timestamp' => now()->toDateTimeString(),
            ]);

            return redirect()->route('tempat.index');
        } catch (\Exception $e) {
            session()->push('notifications', [
                'message' => 'error, Tempat gagal dihapus. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);

            return redirect()->route('tempat.index');
        }
    }
}
