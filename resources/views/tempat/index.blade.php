@extends('layouts.dashboard')

@section('title', 'Daftar Tempat')

@section('content')

<div class="container-fluid">
    <!-- Statistik Card -->
    <div class="row">
        <!-- Tempat Card -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round hover-effect">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Jumlah Tempat</p>
                                <h4 class="card-title">{{ $tempatCount }}</h4> <!-- Jumlah Tempat -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tempat Digunakan -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round hover-effect">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-warning bubble-shadow-small">
                                <i class="fas fa-warehouse"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Tempat Digunakan</p>
                                <h4 class="card-title">{{ $tempatDigunakan }}</h4> <!-- Jumlah Tempat yang digunakan -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tempat Tersedia -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round hover-effect">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-warehouse"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Tempat Tersedia</p>
                                <h4 class="card-title">{{ $tempatTersedia }}</h4> <!-- Jumlah Tempat yang tersedia -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Card untuk Daftar Tempat -->
    <div class="col-md-12">
        <div class="card"> 
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Daftar Tempat</h4>
                    <a href="{{ route('tempat.create') }}" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i> Tambah Tempat Baru
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover w-100" style="min-width: 100%;"> <!-- Tambahkan min-width -->
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th style="width: 15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tempats as $tempat)
                                <tr>
                                    <td>{{ $tempat->id }}</td>
                                    <td>{{ $tempat->name }}</td>
                                    <td>{{ $tempat->alamat }}</td>
                                    <td>
                                        <span class="badge rounded-pill
                                            {{ $tempat->status === 'sedang digunakan' ? 'bg-warning text-white' : '' }}
                                            {{ $tempat->status === 'tersedia' ? 'bg-success text-white' : '' }}">
                                            {{ ucfirst($tempat->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <a href="{{ route('tempat.edit', $tempat->id) }}" class="btn btn-warning btn-sm me-2">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $tempat->id }}">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="deleteModal-{{ $tempat->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $tempat->id }}" aria-hidden="true">
                                    <div class="modal-dialog text-dark">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel-{{ $tempat->id }}">Konfirmasi Penghapusan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-dark">
                                                Apa kamu yakin mau menghapus tempat ini "{{ $tempat->name }}"?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('tempat.destroy', $tempat->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
            "ordering": true,    // Mengaktifkan pengurutan
        });
    });

</script>
@endpush
