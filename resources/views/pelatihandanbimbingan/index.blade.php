@extends('layouts.dashboard')

@section('title', 'Pelatihan dan Bimbingan')

@section('content')
<div class="container-fluid">

    <!-- Statistik Card -->
    <div class="row">
        @if(Auth::user()->group->name === 'Umum')
            <!-- Jumlah Pelatihan -->
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
                                    <p class="card-category">Jumlah Pelatihan</p>
                                    <h4 class="card-title">{{ $totalPelatihan }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pelatihan Akan Hadier -->
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round hover-effect">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="fas fa-hourglass-half"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Pelatihan Akan Hadir</p>
                                    <h4 class="card-title">{{ $pelatihanAkanhadir }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pelatihan Berlangsung -->
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round hover-effect">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-warning bubble-shadow-small">
                                    <i class="fas fa-child"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Pelatihan Berlangsung</p>
                                    <h4 class="card-title">{{ $pelatihanBerlangsung }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah Sisa Kuota Peserta Pelatihan -->
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round hover-effect">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Jumlah Sisa Kuota Per Pelatihan</p>
                                    <div class="notif-scroll scrollbar-outer">
                                        <ul class="list-unstyled">
                                            @foreach($pelatihanDanBimbingan as $pelatihan)
                                                <li class="pelatihan-item">
                                                    {{ $pelatihan->no_pelatihan }} - 
                                                    (Sisa Kuota: {{ $pelatihan->sisa_kuota }})
                                                    <span class="badge rounded-pill
                                                        @if($pelatihan->status == 'akanhadir') bg-primary 
                                                        @elseif($pelatihan->status == 'berlangsung') bg-warning 
                                                        @elseif($pelatihan->status == 'selesai') bg-danger 
                                                        @endif">
                                                        {{ ucfirst($pelatihan->status) }}
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @else

            @if(Auth::user()->group->name === 'SuperAdmin')
            <!-- Jumlah Pelatihan -->
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
                                    <p class="card-category">Jumlah Pelatihan</p>
                                    <h4 class="card-title">{{ $totalPelatihan }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pelatihan Akan Hadier -->
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round hover-effect">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="fas fa-hourglass-half"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Pelatihan Akan Hadir</p>
                                    <h4 class="card-title">{{ $pelatihanAkanhadir }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pelatihan Berlangsung -->
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round hover-effect">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-warning bubble-shadow-small">
                                    <i class="fas fa-child"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Pelatihan Berlangsung</p>
                                    <h4 class="card-title">{{ $pelatihanBerlangsung }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pelatihan Selesai -->
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round hover-effect">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-danger bubble-shadow-small">
                                    <i class="fas fa-power-off"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Pelatihan Selesai</p>
                                    <h4 class="card-title">{{ $pelatihanSelesai }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah Peserta Pelatihan -->
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round hover-effect">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Jumlah Peserta Pelatihan</p>
                                    <h4 class="card-title">{{ $totalPeserta }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif


            <!-- Jumlah Sisa Kuota Peserta Pelatihan -->
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round hover-effect">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-warning bubble-shadow-small">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Jumlah Sisa Kuota Per Pelatihan</p>
                                    <div class="notif-scroll scrollbar-outer" style="max-height: 150px; overflow-y: auto; overflow-x: hidden;">
                                        <ul class="list-unstyled mb-0">
                                            @foreach($pelatihanDanBimbingan as $index => $pelatihan)
                                                <li class="pelatihan-item border-bottom py-1">
                                                    <strong>{{ $pelatihan->no_pelatihan }}</strong> - 
                                                    (Sisa Kuota: {{ $pelatihan->sisa_kuota }})
                                                    <span class="badge rounded-pill
                                                        @if($pelatihan->status == 'akanhadir') bg-primary 
                                                        @elseif($pelatihan->status == 'berlangsung') bg-warning 
                                                        @elseif($pelatihan->status == 'selesai') bg-danger 
                                                        @endif">
                                                        {{ ucfirst($pelatihan->status) }}
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @if(count($pelatihanDanBimbingan) > 2)
                                        <div class="text-center mt-2">
                                            <small class="text-muted">Scroll untuk melihat lebih banyak...</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round hover-effect">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="fas fa-print"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Cetak Data Per-Periode</p>
                                    <!-- Filter Form -->
                                    <form id="filterForm" class="d-flex flex-column">
                                        <div class="row gx-2 gy-2">
                                            <div class="col-12 col-md-6">
                                                <label for="startDate" class="form-label">Tanggal Mulai:</label>
                                                <input type="date" id="startDate" class="form-control" required>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="endDate" class="form-label">Tanggal Akhir:</label>
                                                <input type="date" id="endDate" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row gx-2 gy-2 mt-4"> <!-- mt-4 untuk jarak lebih besar -->
                                            <div class="col-12 col-md-6">
                                                <button type="button" id="filterButton" class="btn btn-info w-100">
                                                    <i class="fas fa-filter me-2"></i> Filter
                                                </button>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <button type="button" id="printButton" class="btn btn-success w-100">
                                                    <i class="fas fa-print me-2"></i> Print
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @if (Auth::user()->group->name === 'SuperAdmin') 
            <!-- Event Card -->
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round hover-effect">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Pelatihan by Bidang</p> 
                                        <h4 class="card-title">
                                            {{ $pelatihanByBidang }} <!-- Jumlah Pelatihan yang dibuat oleh grup selain SuperAdmin dan Umum -->
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (Auth::user()->group->name !== 'SuperAdmin' && Auth::user()->group->name !== 'Umum')
                <!-- Event Card -->
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round hover-effect">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-calendar-week"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Pelatihan-Ku</p>
                                        <h4 class="card-title">
                                            {{ $pelatihanKu }} <!-- Jumlah Pelatihan yang dibuat oleh user -->
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        @endif
    </div>




    <!-- Card untuk Daftar Pelatihan dan Bimbingan -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Daftar Pelatihan dan Bimbingan</h4>
                    @if (auth()->user()->group->name !== 'Umum')
                        <a href="{{ route('pelatihandanbimbingan.create') }}" class="btn btn-primary btn-round ms-auto">
                            <i class="fa fa-plus"></i> Tambah Pelatihan Baru
                        </a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover w-100" style="min-width: 100%;"> <!-- Tambahkan min-width -->
                    <thead>
                        <tr>
                            <th>No Pelatihan</th>
                            <th>Nama Pelatihan</th>
                            <th>Kuota</th>
                            <th>Peserta</th>
                            <th>Tempat</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th style="width: 15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pelatihanDanBimbingan as $pelatihan)
                        @php
                            // Tentukan status berdasarkan tanggal dan waktu_mulai
                            $now = now();
                            $tanggalPelatihan = \Carbon\Carbon::parse($pelatihan->tanggal);
                            $waktuMulai = \Carbon\Carbon::parse($pelatihan->tanggal . ' ' . $pelatihan->waktu_mulai); // Gabungkan tanggal dan waktu_mulai
                            $status = '';

                            if ($tanggalPelatihan->isToday()) { // Cek jika tanggal sama dengan hari ini
                                if ($now->greaterThanOrEqualTo($waktuMulai)) {
                                    // Jika waktu sekarang >= waktu_mulai, status "berlangsung"
                                    $status = 'berlangsung';
                                } elseif ($now->lessThan($waktuMulai)) {
                                    // Jika waktu sekarang < waktu_mulai, status "akanhadir"
                                    $status = 'akanhadir';
                                }
                            } elseif ($tanggalPelatihan->isFuture()) {
                                // Jika tanggal di masa depan
                                $status = 'akanhadir';
                            } else {
                                // Jika tanggal sudah lewat
                                $status = 'selesai';
                            }
                        @endphp

                            <tr data-tanggal="{{ $pelatihan->tanggal }}">
                                <td>{{ $pelatihan->no_pelatihan }}</td>
                                <td>{{ $pelatihan->nama_pelatihan }}</td>
                                <td>{{ $pelatihan->kuota }}</td>
                                <td>{{ $pelatihan->peserta ?? '-' }}</td>
                                <td>{{ $pelatihan->tempat->name }}</td>
                                <td>{{ $pelatihan->tanggal }}</td>
                                <td>
                                    <span class="badge rounded-pill 
                                        {{ $pelatihan->status === 'akanhadir' ? 'bg-primary text-white' : '' }}
                                        {{ $pelatihan->status === 'berlangsung' ? 'bg-warning text-white' : '' }}
                                        {{ $pelatihan->status === 'selesai' ? 'bg-danger text-white' : '' }}">
                                        {{ ucfirst($pelatihan->status) }}
                                    </span>
                                </td>
                                <td>{{ $pelatihan->createdBy ? $pelatihan->createdBy->name : 'N/A' }}</td>
                                <td>{{ $pelatihan->updatedBy ? $pelatihan->updatedBy->name : 'N/A' }}</td>
                                <td>
                                    <div class="d-flex justify-content-start">
                                        @if (auth()->user()->group->name === 'Umum')
                                            @php
                                                $userName = auth()->user()->name;
                                                $existingPeserta = explode(', ', $pelatihan->peserta);
                                                $isPeserta = in_array($userName, $existingPeserta);
                                            @endphp

                                            <!-- Tampilkan tombol 'Ikut Pelatihan' jika belum menjadi peserta dan status adalah 'akanhadir' atau 'berlangsung' -->
                                            @if (!$isPeserta && ($pelatihan->status === 'akanhadir' || $pelatihan->status === 'berlangsung'))
                                                <form action="{{ route('pelatihandanbimbingan.tambahPeserta', $pelatihan->id_pelatihan) }}" method="POST" style="margin-right: 5px;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="fas fa-user-plus"></i> Ikut Pelatihan
                                                    </button>
                                                </form>
                                            @endif

                                            <a href="{{ route('pelatihandanbimbingan.show', $pelatihan->id_pelatihan) }}" class="btn btn-info btn-sm me-2">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        @else
                                            <a href="{{ route('pelatihandanbimbingan.show', $pelatihan->id_pelatihan) }}" class="btn btn-info btn-sm me-2">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>

                                            <!-- Hanya tampilkan tombol Edit jika status pelatihan bukan 'selesai' dan 'berlangsung' -->
                                            @if ($pelatihan->status !== 'selesai' && $pelatihan->status !== 'berlangsung')
                                                <a href="{{ route('pelatihandanbimbingan.edit', $pelatihan->id_pelatihan) }}" class="btn btn-warning btn-sm me-2">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                            @endif

                                            @if(auth()->user()->group->name === 'SuperAdmin')
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $pelatihan->id_pelatihan }}">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal for Deletion -->
                            <div class="modal fade" id="deleteModal-{{ $pelatihan->id_pelatihan }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $pelatihan->id_pelatihan }}" aria-hidden="true">
                                <div class="modal-dialog text-dark">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel-{{ $pelatihan->id_pelatihan }}">Konfirmasi Penghapusan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-dark">
                                            Apa kamu yakin mau menghapus pelatihan ini "{{ $pelatihan->nama_pelatihan }}"?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('pelatihandanbimbingan.destroy', $pelatihan->id_pelatihan) }}" method="POST" style="display:inline;">
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

    
    <!-- card untuk menampilkan peserta -->
    <div class="row">
        @php
            // Pisahkan pelatihan berdasarkan statusnya
            $upcomingAndOngoing = $pelatihanDanBimbingan->filter(function ($pelatihan) {
                return $pelatihan->status === 'akanhadir' || $pelatihan->status === 'berlangsung';
            });

            $completed = $pelatihanDanBimbingan->filter(function ($pelatihan) {
                return $pelatihan->status === 'selesai';
            });

            // Gabungkan kembali pelatihan dengan status akanhadir dan berlangsung di depan
            $pelatihanDanBimbingan = $upcomingAndOngoing->merge($completed);
        @endphp

        @foreach ($pelatihanDanBimbingan as $pelatihan)
            @php
                // Tentukan status background berdasarkan status pelatihan
                $statusClass = match($pelatihan->status) {
                    'akanhadir' => 'bg-primary text-white',
                    'berlangsung' => 'bg-warning text-white',
                    'selesai' => 'bg-danger text-white',
                    default => 'bg-secondary text-white'
                };
                $pesertaList = explode(', ', $pelatihan->peserta);
            @endphp

            <div class="col-md-4 col-sm-6 mb-4"> 
                <div class="card h-100 rounded shadow-lg overflow-hidden" style="min-height: 50px;"> 
                    <div class="card-header {{ $statusClass }} rounded-top">
                        <h5 class="card-title">No Pelatihan: {{ $pelatihan->no_pelatihan }}</h5>
                        <h6 class="card-subtitle">Nama Pelatihan: {{ $pelatihan->nama_pelatihan }}</h6>
                        <small class="form-text">*{{ $pelatihan->tanggal }}* - {{ $pelatihan->waktu_mulai }} WIB</small>
                    </div>
                    <div class="notif-scroll scrollbar-outer rounded-bottom" style="max-height: 50px; overflow-y: auto;">
                        <strong><h6 class="mt-2">Peserta Pelatihan:</h6></strong>
                        <ul class="list-group list-group-flush">
                            @if (count($pesertaList) > 0 && $pesertaList[0] !== '')
                                @php $pesertaIndex = 1; @endphp
                                @foreach ($pesertaList as $peserta)
                                    <li class="list-group-item">
                                        {{ $pesertaIndex++ }}. {{ $peserta }}
                                    </li>
                                @endforeach
                            @else
                                <li class="list-group-item text-muted" style="height: 50px;">Tidak ada peserta.</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>






        
</div>
</div>

@endsection

@push('scripts')
<script>

$(document).ready(function () {
    // Inisialisasi DataTable
    const table = $('#add-row').DataTable({
        "responsive": true,
        "paging": true,
        "searching": true,
        "ordering": true,
    });

    // Fungsi untuk memfilter tabel berdasarkan rentang tanggal
    $('#filterButton').on('click', function () {
        const startDate = $('#startDate').val();
        const endDate = $('#endDate').val();

        if (startDate && endDate) {
            table.draw();
        } else {
            table.draw(); // Render ulang DataTable
        }
    });

    // Filter DataTables berdasarkan tanggal (custom filter)
    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            const startDate = $('#startDate').val();
            const endDate = $('#endDate').val();
            const rowDate = data[5]; // Kolom ke-6 (indeks ke-5) untuk tanggal

            if (!startDate || !endDate) {
                return true; // Tampilkan semua jika tanggal tidak diisi
            }

            return rowDate >= startDate && rowDate <= endDate;
        }
    );

    // Fungsi untuk mencetak hanya data yang difilter
    $('#printButton').on('click', function () {
        let filteredData = table.rows({ filter: 'applied' }).data(); // Ambil hanya baris yang difilter

        let printContent = `
            <html>
            <head>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                <style>
                    .header h2 {
                        margin: 0;
                        padding-bottom: 10px;
                        border-bottom: 3px solid black;
                    }
                    .table {
                        margin-top: 20px;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <h2>Dinas Komunikasi Informasi Dan Statistik Kota Cirebon</h2>
                        <p>DKIS Bypass: Jalan Brigjend Dharsono No. 1, Kel. Sunyararagi, Kec. Kesambi, Kota Cirebon, 45135</p>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No Pelatihan</th>
                                <th>Nama Pelatihan</th>
                                <th>Kuota</th>
                                <th>Peserta</th>
                                <th>Tempat</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
        `;

        // Iterasi melalui data yang difilter
        filteredData.each(function (value) {
            printContent += `
                <tr>
                    <td>${value[0]}</td>
                    <td>${value[1]}</td>
                    <td>${value[2]}</td>
                    <td>${value[3]}</td>
                    <td>${value[4]}</td>
                    <td>${value[5]}</td>
                    <td>${value[6]}</td>
                </tr>
            `;
        });

        printContent += `
                        </tbody>
                    </table>
                </div>
            </body>
            </html>
        `;

        const printWindow = window.open('', '_blank');
        printWindow.document.write(printContent);
        printWindow.document.close();
        printWindow.print();
    });
});


</script>



@endpush
