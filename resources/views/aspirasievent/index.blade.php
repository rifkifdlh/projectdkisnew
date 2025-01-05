@extends('layouts.dashboard')

@section('title', 'Daftar Aspirasi Event')

@section('content')
<div class="container-fluid">
    @if(Auth::user()->group->name !== 'Umum')
    <div class="row">
        <!-- Jumlah Aspirasi -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round hover-effect">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="far fa-file-alt"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Jumlah Aspirasi</p>
                                <h4 class="card-title">{{ $totalAspirasi }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aspirasi Ditinjau -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round hover-effect">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-warning bubble-shadow-small">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Aspirasi Ditinjau</p>
                                <h4 class="card-title">{{ $aspirasiDitinjau }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aspirasi Disetujui -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round hover-effect">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-thumbs-up"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Aspirasi Disetujui</p>
                                <h4 class="card-title">{{ $aspirasiDisetujui }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aspirasi Ditolak -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round hover-effect">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-danger bubble-shadow-small">
                                <i class="fas fa-thumbs-down"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Aspirasi Ditolak</p>
                                <h4 class="card-title">{{ $aspirasiDitolak }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Daftar Aspirasi Event</h4>
                    @if (auth()->user()->group->name === 'Umum')
                    <a href="{{ route('aspirasievent.create') }}" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i> Tambah Aspirasi
                    </a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover w-100" style="min-width: 100%;">
                        <thead>
                            <tr>
                                <th>No Aspirasi</th>
                                <th>Tujuan</th>
                                <th>Manfaat</th>
                                <th>Lampiran Surat</th>
                                <th>Disposisi</th>
                                <th>Status</th>
                                <th>Alasan Ditolak</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($aspirasievents as $aspirasi)
                            <tr>
                                <td>{{ $aspirasi->no_aspirasi }}</td>
                                <td>{{ $aspirasi->tujuan }}</td>
                                <td>{{ $aspirasi->manfaat }}</td>
                                <td>
                                    @if($aspirasi->lampiransurat)
                                    <div class="mb-2">
                                        <iframe 
                                            src="{{ asset('assets/img/lampiransurat/' . basename($aspirasi->lampiransurat)) }}" 
                                            width="100%" 
                                            height="100px" 
                                            frameborder="0">
                                        </iframe>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ asset('assets/img/lampiransurat/' . basename($aspirasi->lampiransurat)) }}" 
                                        target="_blank" 
                                        class="btn btn-sm btn-info d-flex align-items-center">
                                            <i class="fas fa-eye me-1"></i> Lihat
                                        </a>
                                        <a href="{{ route('aspirasievent.download', basename($aspirasi->lampiransurat)) }}" 
                                        class="btn btn-sm btn-success d-flex align-items-center">
                                            <i class="fas fa-download me-1"></i> Unduh
                                        </a>
                                    </div>
                                    @else
                                    Tidak ada lampiran
                                    @endif
                                </td>
                                <td>{{ $aspirasi->disposisi ? $aspirasi->disposisi->name : '-' }}</td>
                                <td>
                                    @if($aspirasi->status === 'ditinjau')
                                    <span class="badge rounded-pill bg-warning text-white">Ditinjau</span>
                                    @elseif($aspirasi->status === 'disetujui')
                                    <span class="badge rounded-pill bg-success text-white">Disetujui</span>
                                    @else
                                    <span class="badge rounded-pill bg-danger text-white">Ditolak</span>
                                    @endif
                                </td>
                                <td>{{ $aspirasi->alasan_ditolak ?? '-' }}</td>
                                <td>{{ $aspirasi->createdBy ? $aspirasi->createdBy->name : 'N/A' }}</td>
                                <td>{{ $aspirasi->updatedBy ? $aspirasi->updatedBy->name : 'N/A' }}</td>

                                <td>
                                    <div class="d-flex justify-content-start">
                                            <a href="{{ route('aspirasievent.edit', $aspirasi->id_aspirasi) }}" class="btn btn-warning btn-sm me-2">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        @if (auth()->user()->group->name === 'SuperAdmin')
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $aspirasi->id_aspirasi }}">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal-{{ $aspirasi->id_aspirasi }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $aspirasi->id_aspirasi }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel-{{ $aspirasi->id_aspirasi }}">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus aspirasi ini?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('aspirasievent.destroy', $aspirasi->id_aspirasi) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center">Tidak ada data.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#add-row').DataTable({
            "responsive": true,  // Memastikan tabel responsif
            "paging": true,      // Mengaktifkan pagination
            "searching": true,   // Mengaktifkan kolom pencarian
            "ordering": true     // Mengaktifkan pengurutan
        });
    });
</script>
@endpush
