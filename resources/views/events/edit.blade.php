@extends('layouts.dashboard')

@section('title', 'Edit Event')

@section('content')
<div class="container">
    <div class="card">
        <!-- Header Card -->
        <div class="card-header">
            <h3 class="card-title">Edit Event</h3>
        </div>

        <!-- Body Card -->
        <div class="card-body">
            <form action="{{ route('events.update', $event->id_event) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label for="no_event">Nomor Event</label>
                            <input 
                                type="text" 
                                name="no_event" 
                                id="no_event" 
                                class="form-control" 
                                value="{{ old('no_event', $event->no_event) }}" 
                                readonly>
                        </div>

                        <div class="form-group form-group-default">
                            <label for="nama_event">Nama Event</label>
                            <input 
                                type="text" 
                                name="nama_event" 
                                id="nama_event" 
                                class="form-control" 
                                value="{{ old('nama_event', $event->nama_event) }}" 
                                placeholder="Isi nama event"
                                required>
                        </div>

                        <div class="form-group form-group-default">
                            <label for="deskripsi_singkat">Deskripsi Singkat</label>
                            <textarea 
                                name="deskripsi_singkat" 
                                id="deskripsi_singkat" 
                                class="form-control" 
                                placeholder="Isi deskripsi singkat event">{{ old('deskripsi_singkat', $event->deskripsi_singkat ?? '') }}</textarea>
                        </div>

                        <div class="form-group form-group-default">
                            <label for="tempat_id">Tempat</label>
                            <select name="tempat_id" id="tempat_id" class="form-select" required>
                                @foreach($tempats as $tempat)
                                    <option value="{{ $tempat->id }}" {{ $tempat->id == old('tempat_id', $event->tempat_id) ? 'selected' : '' }}>
                                        {{ $tempat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group form-group-default">
                            <label for="tanggal">Tanggal</label>
                            <input 
                                type="date" 
                                name="tanggal" 
                                id="tanggal" 
                                class="form-control" 
                                value="{{ old('tanggal', $event->tanggal) }}" 
                                required>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label for="status">Status</label>
                            <!-- Input hidden untuk mengirim status ke server -->
                            <input  type="text"
                                    id="status"
                                    name="status"
                                    class="form-control"
                                    value="{{ old('status', $event->status) }}"
                                    readonly>
                        </div>

                        <div class="form-group form-group-default">
                            <label for="photo">Photo</label>
                            <input type="file" 
                                    name="photo" 
                                    id="photo" 
                                    class="form-control" 
                                    accept="image/*"
                                    onchange="previewPhoto(event)">
                            <small class="form-text text-muted">Unggah file dengan format jpeg,png,jpg,gif|max:2 MB</small>
                            @if($event->photo)
                                <p class="mt-2">Photo saat ini: 
                                    <img 
                                    src="{{ $event->photo ? asset('assets/img/eventsdkis/' . $event->photo) : asset('assets/img/eventsdkis/default.png') }}"                                    alt="Photo Event" 
                                    width="100" style="border: 1px solid #ddd;">
                                </p>
                            @endif
                            <!-- Tambahan preview foto -->
                            <img id="photo-preview" 
                                 class="rounded" 
                                 style="display: none; width: 100px; height: 100px; object-fit: cover; border: 1px solid #ddd;">
                        </div>

                        <div class="form-group form-group-default">
                            <label for="waktu_mulai">Waktu Mulai</label>
                            <input 
                                type="time" 
                                name="waktu_mulai" 
                                id="waktu_mulai" 
                                class="form-control" 
                                value="{{ old('waktu_mulai', $event->waktu_mulai) }}">
                        </div>

                        <div class="form-group form-group-default">
                            <label for="waktu_selesai">Waktu Selesai</label>
                            <input 
                                type="time" 
                                name="waktu_selesai" 
                                id="waktu_selesai" 
                                class="form-control" 
                                value="{{ old('waktu_selesai', $event->waktu_selesai) }}">
                        </div>
                    </div>

                    <div class="card-footer text-first">
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        <a href="{{ route('events.index') }}" class="btn btn-danger">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Fungsi untuk menampilkan preview foto
    function previewPhoto(event) {
        const photoInput = event.target;
        const photoPreview = document.getElementById('photo-preview');
        const file = photoInput.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                photoPreview.src = e.target.result;
                photoPreview.style.display = 'block'; // Tampilkan preview
            };

            reader.readAsDataURL(file);
        } else {
            photoPreview.style.display = 'none'; // Sembunyikan preview
        }
    }
</script>
@endsection
