<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tempat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class EventController extends Controller
{
    public function index()
    {
          // Dapatkan jumlah event
        $eventJumlah = Event::count();

          // Dapatkan jumlah event yang statusnya "berlangsunb"
        $eventAkanhadir = Event::where('status', 'akanhadir')->count();
          // Dapatkan jumlah event yang statusnya "berlangsunb"
        $eventBerlangsung = Event::where('status', 'berlangsung')->count();
          // Dapatkan jumlah event yang statusnya "berlangsunb"
        $eventSelesai = Event::where('status', 'selesai')->count();

        $Events = Event::with(['tempat', 'createdBy', 'updatedBy'])->get();
        return view('events.index', compact('Events', 'eventJumlah', 'eventBerlangsung', 'eventAkanhadir', 'eventSelesai'));
    }

    public function show($id)
    {
        $event = Event::with(['tempat', 'createdBy', 'updatedBy'])->findOrFail($id);
        return view('events.show', compact('event'));
    }



    public function akhiriEvent($id)
    {
        try {
            $event = Event::findOrFail($id);
    
            // Periksa apakah waktu_selesai kosong
            if (empty($event->waktu_selesai)) {
                $event->waktu_selesai = now()->format('H:i');
            }
    
            // Update status event menjadi selesai
            $event->update([
                'status' => 'selesai',
                'waktu_selesai' => $event->waktu_selesai
            ]);
    
            // Update status tempat menjadi tersedia
            $tempat = Tempat::find($event->tempat_id);
            $tempat->update(['status' => 'tersedia']);
    
            session()->push('notifications', [
                'message' => 'success, Event berhasil diakhiri.',
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('events.show', $id);
        } catch (\Exception $e) {
            session()->push('notifications', [
                'message' => 'error, Terjadi kesalahan: ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('events.show', $id);
        }
    }
    

    public function create()
    {
        // Get available places (status = 'tersedia')
        $tempats = Tempat::where('status', 'tersedia')->get();

        return view('events.create', compact('tempats'));
    }

    public function store(Request $request)
    {
        try {
            // Generate no_event using the format -<timestamp>
            $no_event = 'Evtdkisn - ' . time();
    
            // Validasi data input
            $validated = $request->validate([
                'nama_event' => 'required|string|max:50',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'deskripsi_singkat' => 'nullable|string|max:100',
                'tempat_id' => 'required|integer|exists:tempat,id',
                'tanggal' => 'required|date',
                'waktu_mulai' => 'nullable|date_format:H:i',
                'waktu_selesai' => 'nullable|date_format:H:i|after:waktu_mulai',
            ]);
    
            // Jika waktu_mulai tidak diisi, gunakan waktu saat ini
            if (!$request->filled('waktu_mulai')) {
                $validated['waktu_mulai'] = now()->format('H:i');
            }

              // Tangani unggahan file photo
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $photoExtension = $request->photo->getClientOriginalExtension();
                $photoName = time() . '_event_' . Str::random(8) . '.' . $photoExtension;
                $request->photo->move(public_path('assets/img/eventsdkis'), $photoName);
                $validated['photo'] = $photoName;
            } else {
                $validated['photo'] = null;
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
            $validated['no_event'] = $no_event;
    
            // Create the new Event
            Event::create($validated);
    
            // Update the tempat status to 'sedang digunakan'
            $tempat = Tempat::find($request->tempat_id);
            $tempat->update(['status' => 'sedang digunakan']);
    
            // Success notification
            session()->push('notifications', [
                'message' => 'success, Event berhasil ditambahkan.',
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('events.index');
        } catch (\Exception $e) {
            // Error notification
            session()->push('notifications', [
                'message' => 'error, Event gagal ditambahkan. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('events.create');
        }
    }
    

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $tempats = Tempat::where('status', 'tersedia')->orWhere('id', $event->tempat_id)->get();
        
        return view('events.edit', compact('event', 'tempats'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validasi data input
            $validated = $request->validate([
                'nama_event' => 'required|string|max:50',
                'deskripsi_singkat' => 'nullable|string|max:100',
                'tempat_id' => 'required|integer|exists:tempat,id',
                'tanggal' => 'required|date',
                'waktu_mulai' => 'nullable|date_format:H:i',
                'waktu_selesai' => 'nullable|date_format:H:i|after:waktu_mulai',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            // Cari event berdasarkan ID
            $event = Event::findOrFail($id);
    
            // Tangani unggahan foto baru
            $validated['photo'] = $event->photo; // Default gunakan foto lama
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                // Hapus foto lama jika bukan default
                if ($event->photo && $event->photo !== 'default.png' && file_exists(public_path('assets/img/eventsdkis/' . $event->photo))) {
                    unlink(public_path('assets/img/eventsdkis/' . $event->photo));
                }
    
                // Simpan foto baru
                $photoExtension = $request->photo->getClientOriginalExtension();
                $photoName = time() . '_event_' . Str::random(8) . '.' . $photoExtension;
                $request->photo->move(public_path('assets/img/eventsdkis'), $photoName);
                $validated['photo'] = $photoName;
            }
    
            // Tangani waktu mulai dan selesai
            $validated['waktu_mulai'] = $request->filled('waktu_mulai') 
                ? $request->waktu_mulai 
                : $event->waktu_mulai;
    
            $validated['waktu_selesai'] = $request->filled('waktu_selesai') 
                ? $request->waktu_selesai 
                : $event->waktu_selesai;
    
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
    
            // Tambahkan status lama ke $validated karena tidak diubah
            $validated['status'] = $event->status;
    
            // Perbarui data event dengan $validated
            $event->update($validated);
    
            // Notifikasi sukses
            session()->push('notifications', [
                'message' => 'success, Event berhasil diperbarui.',
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('events.index');
        } catch (\Exception $e) {
            // Notifikasi error
            session()->push('notifications', [
                'message' => 'error, Event gagal diperbarui. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('events.edit', $id)->withInput();
        }
    }
    


    
    
    
    

    public function destroy($id)
    {
        try {
            $event = Event::findOrFail($id);
            $photoPath = $event->photo;
    
            // Hapus foto jika ada
            if ($photoPath && $photoPath !== 'default.png' && file_exists(public_path('assets/img/eventsdkis/' . $photoPath))) {
                unlink(public_path('assets/img/eventsdkis/' . $photoPath));
            }
    
            // Update status tempat menjadi tersedia jika tempat_id valid
            if (!is_null($event->tempat_id)) {
                $tempat = Tempat::find($event->tempat_id);
                if ($tempat) {
                    $tempat->update(['status' => 'tersedia']);
                }
            }
    
            // Hapus event
            $event->delete();
    
            session()->push('notifications', [
                'message' => 'success, Event berhasil dihapus.',
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('events.index');
        } catch (\Exception $e) {
            session()->push('notifications', [
                'message' => 'error, Event gagal dihapus. ' . $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('events.index');
        }
    }
    
}