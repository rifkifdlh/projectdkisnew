@extends('layouts.dashboard')

@section('title', 'Edit Aspirasi Event')

@section('content')
<div class="container">
    <div class="card">
        <!-- Header Card -->
        <div class="card-header">
            <h3 class="card-title">Edit Aspirasi Event</h3>
        </div>

        <!-- Body Card -->
        <div class="card-body">
            <form action="{{ route('aspirasievent.update', $aspirasi->id_aspirasi) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label for="no_aspirasi">No Aspirasi</label>
                            <input
                                type="text"
                                id="no_aspirasi"
                                name="no_aspirasi"
                                class="form-control"
                                value="{{ old('no_aspirasi', $aspirasi->no_aspirasi) }}" 
                                readonly
                            />
                        </div>

                        <div class="form-group form-group-default">
                            <label for="tujuan">Tujuan</label>
                            <input
                                type="text"
                                id="tujuan"
                                name="tujuan"
                                class="form-control"
                                value="{{ old('tujuan', $aspirasi->tujuan) }}"
                                placeholder="Isi tujuan aspirasi"
                                required
                                {{ auth()->user()->group->name !== 'Umum' || $aspirasi->disposisi_id ? 'readonly' : '' }}>
                        </div>

                        <div class="form-group form-group-default">
                            <label for="manfaat">Manfaat</label>
                            <textarea
                                class="form-control"
                                id="manfaat"
                                name="manfaat"
                                rows="3"
                                placeholder="Deskripsikan manfaat aspirasi"
                                required
                                {{ auth()->user()->group->name !== 'Umum' || $aspirasi->disposisi_id ? 'readonly' : '' }}>{{ old('manfaat', $aspirasi->manfaat) }}</textarea>
                        </div>

                        <div class="form-group form-group-default">
                            <label for="lampiransurat">Lampiran Surat</label>
                            <input
                                type="file"
                                class="form-control"
                                id="lampiransurat"
                                name="lampiransurat"
                                accept=".pdf,.doc,.docx"
                                {{ auth()->user()->group->name !== 'Umum' || $aspirasi->disposisi_id ? 'disabled' : '' }}>
                            <small class="form-text text-muted">Unggah file dengan format .pdf, .doc, atau .docx|max:20 MB</small>
                        </div>

                    </div>


                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                    @if (Auth::user()->group->name !== 'Umum' && Auth::user()->group->name !== 'SuperAdmin')
                        <div class="form-group form-group-default">
                            <label for="status">Status</label>
                            <select class="form-select" id="status" name="status" required>
                            <option value="" disabled selected>Pilih Status</option> <!-- Placeholder -->
                                <option value="ditinjau" {{ old('status', $aspirasi->status) == 'ditinjau' ? 'selected' : '' }}>Ditinjau</option>
                                <option value="disetujui" {{ old('status', $aspirasi->status) == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="ditolak" {{ old('status', $aspirasi->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>

                        <div class="form-group form-group-default">
                            <label for="alasan_ditolak">Alasan Ditolak</label>
                            <textarea
                                class="form-control"
                                id="alasan_ditolak"
                                name="alasan_ditolak"
                                rows="3"
                                placeholder="Alasan ditolak jika ada">{{ old('alasan_ditolak', $aspirasi->alasan_ditolak) }}</textarea>
                        </div>
                    </div>
                    @endif

                    @if (Auth::user()->group->name === 'SuperAdmin')
                        <div class="form-group form-group-default">
                            <label for="disposisi">Disposisi</label>
                            <select name="disposisi_id" id="disposisi_id" class="form-select" 
                                    {{ in_array($aspirasi->status, ['disetujui', 'ditolak']) ? 'disabled' : '' }}>
                                <option value="">
                                    {{ old('disposisi_id', $aspirasi->disposisi_id) ? 'Kosongkan Disposisi' : 'Pilih Disposisi' }}
                                </option> <!-- Dinamis berdasarkan status disposisi -->
                                @foreach ($disposisiOptions as $group)
                                    <option value="{{ $group->id }}" 
                                            {{ $group->id == old('disposisi_id', $aspirasi->disposisi_id) ? 'selected' : '' }}>
                                        {{ $group->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>
        </div>

        <!-- Footer Card -->
        <div class="card-footer text-start">
            @if (Auth::user()->group->name === 'Umum')
                @if ($aspirasi->disposisi_id)
                    <p class="text-danger">Surat sudah di disposisikan oleh Admin, tidak bisa di edit!</p>
                @else
                    <p class="text-warning">Jika surat sudah di disposisikan oleh Admin, anda tidak dapat mengeditnya kembali.</p>
                    <button type="submit" class="btn btn-success">Update</button>
                @endif
            @elseif (Auth::user()->group->name === 'SuperAdmin')
                @if (in_array($aspirasi->status, ['disetujui', 'ditolak']))
                    <p class="text-danger">Surat sudah disetujui atau ditolak oleh Bidang, tidak bisa di edit!</p>
                @else
                <p class="text-warning">Jika surat sudah distujui atau ditolak oleh Bidang, anda tidak dapat mendisposisikan kembali.</p>
                    <button type="submit" class="btn btn-success">Update</button>
                @endif
            @else
                <button type="submit" class="btn btn-success">Update</button>
            @endif
            <a href="{{ route('aspirasievent.index') }}" class="btn btn-danger">Kembali</a>
        </div>

    </form>
</div>
</div>
</div>
@endsection
