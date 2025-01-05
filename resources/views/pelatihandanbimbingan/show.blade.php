@extends('layouts.dashboard')

@section('title', 'Detail Pelatihan dan Bimbingan')

@section('content')

<div class="container-fluid">
    <!-- Detail Pelatihan dan Bimbingan -->
    <div class="col-md-12">
        <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Detail Pelatihan dan Bimbingan</h4>
            @if ($pelatihan->status === 'akanhadir')
                <span class="status-message text-primary">
                    Pelatihan dan Bimbingan Akan Hadir 
                    @if(isset($pelatihan->no_pelatihan))
                        (No. Pelatihan: {{ $pelatihan->no_pelatihan }})
                    @endif
                </span>
            @elseif ($pelatihan->status === 'berlangsung')
                <span class="status-message text-warning">
                    Pelatihan dan Bimbingan Sedang Berlangsung 
                    @if(isset($pelatihan->no_pelatihan))
                        (No. Pelatihan: {{ $pelatihan->no_pelatihan }})
                    @endif
                </span>
            @elseif ($pelatihan->status === 'selesai')
                <span class="status-message text-danger">
                    Pelatihan dan Bimbingan Telah Selesai 
                    @if(isset($pelatihan->no_pelatihan))
                        (No. Pelatihan: {{ $pelatihan->no_pelatihan }})
                    @endif
                </span>
            @endif
        </div>


            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>No. Pelatihan:</th>
                        <th>{{ $pelatihan->no_pelatihan }}</th>
                    </tr>
                    <tr>
                        <th>Nama Pelatihan:</th>
                        <td>{{ $pelatihan->nama_pelatihan }}</td>
                    </tr>
                    <tr>
                        <th>Kuota Peserta:</th>
                        <td>{{ $pelatihan->kuota }}</td>
                    </tr>
                    <tr>
                        <th>Peserta:</th>
                        <td>{{ $pelatihan->peserta }}</td>
                    </tr>
                    <tr>
                        <th>Mentor/Pelatih:</th>
                        <td>{{ $pelatihan->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Nama Group:</th>
                        <td>{{ $pelatihan->group->name }}</td>
                    </tr>
                    <tr>
                        <th>Tempat:</th>
                        <td>{{ $pelatihan->tempat->name }}</td>
                    </tr>
                    <tr>
                        <th>Status Tempat:</th>
                        <td>{{ $pelatihan->tempat->status }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pelatihan:</th>
                        <td>{{ $pelatihan->tanggal }}</td>
                    </tr>
                    <tr>
                        <th>Waktu Mulai:</th>
                        <td>{{ $pelatihan->waktu_mulai }}</td>
                    </tr>
                    <tr>
                        <th>Waktu Selesai:</th>
                        <td>{{ $pelatihan->waktu_selesai }}</td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>
                            <span class="badge rounded-pill 
                                {{ $pelatihan->status === 'akanhadir' ? 'bg-primary text-white' : '' }}
                                {{ $pelatihan->status === 'berlangsung' ? 'bg-warning text-white' : '' }}
                                {{ $pelatihan->status === 'selesai' ? 'bg-danger text-white' : '' }}">
                                {{ ucfirst($pelatihan->status) }}
                            </span>
                        </td>
                    </tr>
                </table>

                @if ($pelatihan->status === 'selesai')
                    <div class="finished-image-wrapper">
                        <img 
                            src="{{ asset('assets/img/status/finished.png') }}" 
                            alt="Finished" 
                            class="finished-image"
                        />
                    </div>
                @endif

            </div>

            <div class="card-footer d-flex justify-content-start">
                @if (auth()->user()->group->name === 'Umum')
                    <!-- Hanya tombol Kembali untuk grup Umum -->
                    <a href="{{ route('pelatihandanbimbingan.index') }}" class="btn btn-secondary">Kembali</a>
                @else
                    <!-- Tombol Akhiri Pelatihan jika grup bukan Umum dan tanggal hari ini sesuai dengan tanggal pelatihan -->
                    @if ($pelatihan->status === 'berlangsung')
                        <form action="{{ route('pelatihandanbimbingan.akhiriPelatihan', $pelatihan->id_pelatihan) }}" method="POST" class="me-2">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-power-off"></i> Akhiri Pelatihan
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('pelatihandanbimbingan.index') }}" class="btn btn-secondary">Kembali</a>
                @endif
            </div>


        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
    .table th, 
    .table td {
        padding: 0.5rem; /* Mengatur jarak padding */
        vertical-align: top; /* Mengatur posisi teks */
    }

    .table th {
        width: 25%; /* Mengatur lebar kolom label */
        text-align: left; /* Memastikan label rata kiri */
    }

    .table td {
        width: 75%; /* Mengatur lebar kolom isi */
    }

    .card-body {
        position: relative; /* Make sure that any absolutely positioned elements are relative to this container */
    }

    .status-message {
        font-weight: bold;
        font-size: 18px;
        padding: 10px 20px;
        border: 2px solid #ccc; /* Box border */
        border-radius: 12px; /* Rounded corners */
        background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
        display: inline-block;
    }

    .text-danger {
        color: red;
    }

    .text-warning {
        color: orange;
    }

    .text-primary {
        color: blue;
    }

    .finished-image-wrapper {
        position: absolute; /* Positioning it absolutely within the .card-body */
        top: 50%; /* Align vertically to the middle */
        left: 40%; /* Align horizontally to the middle */
        transform: translate(-50%, -50%); /* Offset to perfectly center the image */
        width: 100%; /* Make it as wide as the table */
        height: 100%; /* Make it as tall as the table */
        z-index: 9999; /* Ensure it's above the table */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .finished-image {
        width: 430px; /* Adjust size to make it bigger */
        animation: fadeInRotate 1.5s ease-in-out;
        transform: rotate(-15deg);
        opacity: 0.8; /* Apply opacity to the image */

    }

    @keyframes fadeInRotate {
        0% {
            opacity: 0.7;
            transform: rotate(-30deg) scale(0.8);
        }
        100% {
            opacity: 0.7;
            transform: rotate(-15deg) scale(1);
        }
    }
</style>
@endpush
