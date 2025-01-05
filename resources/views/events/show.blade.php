@extends('layouts.dashboard')

@section('title', 'Detail Event')

@section('content')

<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Detail Event</h4>
                @if ($event->status === 'akanhadir')
                    <span class="status-message text-primary">
                        Event Akan Hadir 
                        @if(isset($event->no_event))
                            (No. Event: {{ $event->no_event }})
                        @endif
                    </span>
                @elseif ($event->status === 'berlangsung')
                    <span class="status-message text-warning">
                        Event Sedang Berlangsung 
                        @if(isset($event->no_event))
                            (No. Event: {{ $event->no_event }})
                        @endif
                    </span>
                @elseif ($event->status === 'selesai')
                    <span class="status-message text-danger">
                        Event Telah Selesai 
                        @if(isset($event->no_event))
                            (No. Event: {{ $event->no_event }})
                        @endif
                    </span>
                @endif
            </div>

            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>No. Event:</th>
                        <th>{{ $event->no_event }}</th>
                    </tr>
                    <tr>
                        <th>Nama Event:</th>
                        <td>{{ $event->nama_event }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi Singkat:</th>
                        <td>{{ $event->deskripsi_singkat }}</td>
                    </tr>
                    <tr>
                        <th>Tempat:</th>
                        <td>{{ $event->tempat->name }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal:</th>
                        <td>{{ $event->tanggal }}</td>
                    </tr>
                    <tr>
                        <th>Waktu Mulai:</th>
                        <td>{{ $event->waktu_mulai }}</td>
                    </tr>
                    <tr>
                        <th>Waktu Selesai:</th>
                        <td>{{ $event->waktu_selesai }}</td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>
                                <span class="badge rounded-pill 
                                    {{ $event->status === 'akanhadir' ? 'bg-primary text-white' : '' }}
                                    {{ $event->status === 'berlangsung' ? 'bg-warning text-white' : '' }}
                                    {{ $event->status === 'selesai' ? 'bg-danger text-white' : '' }}">
                                    {{ ucfirst($event->status) }}
                                </span>
                    </tr>
                </table>
                
                @if ($event->status === 'selesai')
                    <div class="theend-image-wrapper">
                        <img 
                            src="{{ asset('assets/img/status/theend.png') }}" 
                            alt="Theend" 
                            class="theend-image"
                        />
                    </div>
                @endif
            </div>
            <div class="card-footer d-flex justify-content-start">
                <!-- Tombol Kembali -->
                <!-- Hanya tombol Kembali untuk grup Umum -->
                @if (auth()->user()->group->name === 'Umum')
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">Kembali</a>
                @else
                    <!-- Tombol Akhiri event (Hanya tampil jika event belum selesai) -->
                    @if ($event->status === 'berlangsung')
                        <form action="{{ route('event.akhiri', $event->id_event) }}" method="POST" class="me-2">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-power-off"></i> Akhiri Event
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">Kembali</a>
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

    .text-success {
        color: green;
    }

    .text-warning {
        color: orange;
    }

    .theend-image-wrapper {
        position: absolute; /* Positioning it absolutely within the .card-body */
        top: 40%; /* Align vertically to the middle */
        left: 40%; /* Align horizontally to the middle */
        transform: translate(-50%, -50%); /* Offset to perfectly center the image */
        width: 100%; /* Make it as wide as the table */
        height: 100%; /* Make it as tall as the table */
        z-index: 9999; /* Ensure it's above the table */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .theend-image {
        width: 400px; /* Adjust size to make it bigger */
        animation: fadeInRotate 1.5s ease-in-out;
        transform: rotate(-5deg);
        opacity: 0.9; /* Apply opacity to the image */

    }

    @keyframes fadeInRotate {
        0% {
            opacity: 0.7;
            transform: rotate(-30deg) scale(0.8);
        }
        100% {
            opacity: 0.9;
            transform: rotate(-5deg) scale(1);
        }
    }

</style>
@endpush