<?php

namespace App\Http\Controllers;

use App\Models\AspirasiEvent;
use Illuminate\Support\Facades\Response;  // For handling file responses
use Illuminate\Http\Request;
use App\Models\Group; // Untuk disposisi
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AspirasiEventController extends Controller
{
    public function index()
    {
        try {
            $userGroup = Auth::user()->group->name; // Grup user yang sedang login
            $userId = Auth::id(); // ID user yang sedang login
    
            if ($userGroup === 'SuperAdmin') {
                // Jika SuperAdmin, tampilkan semua data
                $aspirasievents = AspirasiEvent::with(['disposisi', 'createdBy', 'updatedBy'])->get();
            } elseif ($userGroup === 'Umum') {
                // Jika Umum, hanya tampilkan data yang dibuat oleh user yang login
                $aspirasievents = AspirasiEvent::with(['disposisi', 'createdBy', 'updatedBy'])
                    ->where('created_id', $userId)
                    ->get();
            } else {
                // Filter berdasarkan disposisi_id sesuai dengan grup user yang login
                $allowedGroups = ['E-Government', 'ITIK', 'Persandian', 'PIKP', 'Statistik', 'Sekretariat'];
                if (in_array($userGroup, $allowedGroups)) {
                    $aspirasievents = AspirasiEvent::with(['disposisi', 'createdBy', 'updatedBy'])
                        ->whereHas('disposisi', function ($query) use ($userGroup) {
                            $query->where('name', $userGroup); // Tampilkan hanya data sesuai grup login
                        })
                        ->get();
                } else {
                    // Jika grup tidak sesuai, tampilkan data kosong
                    $aspirasievents = collect([]);
                }
            }
    
            // Hitung total aspirasi
            $totalAspirasi = $aspirasievents->count();
    
            // Hitung aspirasi berdasarkan status
            $aspirasiDitinjau = $aspirasievents->where('status', 'ditinjau')->count();
            $aspirasiDisetujui = $aspirasievents->where('status', 'disetujui')->count();
            $aspirasiDitolak = $aspirasievents->where('status', 'ditolak')->count();
    
            return view('aspirasievent.index', compact('aspirasievents', 'totalAspirasi', 'aspirasiDitinjau', 'aspirasiDisetujui', 'aspirasiDitolak'));
        } catch (\Exception $e) {
            // Error notification
            session()->push('notifications', [
                'message' => 'error, Gagal memuat data aspirasi. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->back();
        }
    }
    
    
    

    public function download($filename)
    {
        try {
            $filePath = public_path('assets/img/lampiransurat/' . $filename);

            // Check if the file exists
            if (file_exists($filePath)) {
                return Response::download($filePath, $filename, [
                    'Content-Type' => mime_content_type($filePath),
                    'Content-Disposition' => 'attachment; filename="' . basename($filePath) . '"',
                ]);
            } else {
                // File not found
                session()->push('notifications', [
                    'message' => 'error, File tidak ditemukan.',
                    'timestamp' => now()->toDateTimeString(),
                ]);
                return redirect()->back();
            }
        } catch (\Exception $e) {
            // Error handling
            session()->push('notifications', [
                'message' => 'error, Gagal mendownload file. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);
            return redirect()->back();
        }
    }

    public function create()
    {
        try {
            $disposisiOptions = Group::whereNotIn('name', ['SuperAdmin', 'Umum'])->get();
    
            return view('aspirasievent.create', compact('disposisiOptions'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    

    public function store(Request $request)
    {
        try {
            // Generate no_aspirasi using the format -<timestamp>
            $no_aspirasi = 'AspEvent - ' . time();
    
            // Jika pengguna yang login adalah 'Umum', atur status ke 'ditinjau' secara otomatis
            if (Auth::user()->group->name === 'Umum') {
                $request->merge(['status' => 'ditinjau']); // Tambahkan status 'ditinjau' jika grup adalah 'Umum'
            }
    
            $validated = $request->validate([
                'tujuan' => 'required|string|max:255',
                'manfaat' => 'required|string|max:255',
                'lampiransurat' => 'required|file|mimes:pdf,docx,doc|max:20048',
                'disposisi_id' => 'nullable|exists:groups,id',
                'status' => 'nullable|in:ditinjau,disetujui,ditolak', // Validasi status tetap diperlukan
                'alasan_ditolak' => 'nullable|string|max:255',
            ]);
    
            // Add the no_aspirasi to validated data
            $validated['no_aspirasi'] = $no_aspirasi;
    
            if ($request->hasFile('lampiransurat')) {
                $file = $request->file('lampiransurat');
                $fileName = time() . '_surat_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('assets/img/lampiransurat');
                $file->move($destinationPath, $fileName);
                $validated['lampiransurat'] = $fileName;
            }
    
            // Add the generated no_aspirasi to the validated data
            $validated['no_aspirasi'] = $no_aspirasi;
    
            // Create the AspirasiEvent
            AspirasiEvent::create($validated);
    
            // Success notification
            session()->push('notifications', [
                'message' => 'success, Aspirasi berhasil ditambahkan.',
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('aspirasievent.index');
        } catch (\Exception $e) {
            // Error notification
            session()->push('notifications', [
                'message' => 'error, Aspirasi gagal ditambahkan. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->back();
        }
    }
    


    public function edit($id)
    {
        try {
            $aspirasi = AspirasiEvent::findOrFail($id);
            $disposisiOptions = Group::whereNotIn('name', ['SuperAdmin', 'Umum'])->get();
    
            return view('aspirasievent.edit', compact('aspirasi', 'disposisiOptions'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    

    public function update(Request $request, $id)
    {
        try {

            // Jika pengguna yang login adalah 'Umum', atur status ke 'ditinjau' secara otomatis
            if (Auth::user()->group->name === 'Umum') {
            $request->merge(['status' => 'ditinjau']); // Tambahkan status 'ditinjau' jika grup adalah 'Umum'
            }

            $validated = $request->validate([
                'no_aspirasi' => 'required|string|max:50',
                'tujuan' => 'required|string|max:255',
                'manfaat' => 'required|string|max:255',
                'lampiransurat' => 'nullable|file|mimes:pdf,docx,doc|max:20048',
                'disposisi_id' => 'nullable|exists:groups,id',
                'status' => 'nullable|in:ditinjau,disetujui,ditolak',
                'alasan_ditolak' => 'nullable|string|max:255',
            ]);
    
            $aspirasi = AspirasiEvent::findOrFail($id);
    
            // If the file is uploaded, process it
            if ($request->hasFile('lampiransurat')) {
                // Delete the old file if exists
                if ($aspirasi->lampiransurat && file_exists(public_path($aspirasi->lampiransurat))) {
                    unlink(public_path($aspirasi->lampiransurat));
                }
    
                $file = $request->file('lampiransurat');
                $fileName = time() . '_surat_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('assets/img/lampiransurat');
                $file->move($destinationPath, $fileName);
                $validated['lampiransurat'] = $fileName;
            }
    
            // Update the record with new data
            $aspirasi->update($validated);
    
            // Success notification
            session()->push('notifications', [
                'message' => 'success, Aspirasi berhasil diperbarui.',
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('aspirasievent.index');
        } catch (\Exception $e) {
            // Error notification
            session()->push('notifications', [
                'message' => 'error, Aspirasi gagal diperbarui. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $aspirasi = AspirasiEvent::findOrFail($id);

            // Hapus file lampiran
            if ($aspirasi->lampiransurat && file_exists(public_path($aspirasi->lampiransurat))) {
                unlink(public_path($aspirasi->lampiransurat));
            }

            $aspirasi->delete();

            // Notifikasi sukses
            session()->push('notifications', [
                'message' => 'success, Aspirasi berhasil dihapus.',
                'timestamp' => now()->toDateTimeString(),
            ]);

            return redirect()->route('aspirasievent.index');
        } catch (\Exception $e) {
            // Notifikasi error
            session()->push('notifications', [
                'message' => 'error, Aspirasi gagal dihapus. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);

            return redirect()->back();
        }
    }
}
