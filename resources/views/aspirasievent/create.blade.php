@extends('layouts.dashboard')

@section('title', 'Tambah Aspirasi Event')

@section('content')
<div class="container">
    <div class="card">
        <!-- Header Card -->
        <div class="card-header">
            <h3 class="card-title">Tambah Aspirasi Event</h3>
        </div>

        <!-- Body Card -->
        <div class="card-body">
            <form action="{{ route('aspirasievent.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
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
                                value="{{ 'Aspevnt - ' . time() }}"
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
                                placeholder="Isi tujuan aspirasi"
                                required
                            />
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
                            ></textarea>
                        </div>

                        <div class="form-group form-group-default">
                            <label for="lampiransurat">Lampiran Surat</label>
                            <input type="file" class="form-control" id="lampiransurat" name="lampiransurat" accept=".pdf,.doc,.docx">
                            <small class="form-text text-muted">Unggah file dengan format .pdf, .doc, atau .docx|max:20 MB</small>
                        </div>
                    </div>

                   <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        @if (Auth::user()->group->name !== 'Umum')
                            <div class="form-group form-group-default">
                                <label for="alasan_ditolak">Alasan Ditolak</label>
                                <textarea
                                    class="form-control"
                                    id="alasan_ditolak"
                                    name="alasan_ditolak"
                                    rows="3"
                                    placeholder="Alasan ditolak jika ada"
                                ></textarea>
                            </div>

                            <div class="form-group form-group-default">
                                <label for="disposisi">Disposisi</label>
                                <select name="disposisi_id" id="disposisi_id" class="form-select">
                                    @foreach ($disposisiOptions as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group form-group-default">
                                <label for="status">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="ditinjau">Ditinjau</option>
                                    <option value="disetujui">Disetujui</option>
                                    <option value="ditolak">Ditolak</option>
                                </select>
                            </div>
                        @endif
                    </div>
                      
                    </div>
                </div>
            <!-- Footer Card -->
            <div class="card-footer text-start">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('aspirasievent.index') }}" class="btn btn-danger">Kembali</a>
            </div>
        </div>

        
    </form>
</div>
</div>
</div>
@endsection
