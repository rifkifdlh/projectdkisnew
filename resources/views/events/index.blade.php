@extends('layouts.dashboard')

@section('title', 'Daftar Events')

@section('content')

<div class="container-fluid">
    <!-- Statistik Card -->
    <div class="row">
        @if(Auth::user()->group->name !== 'Umum')
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
                                <p class="card-category">Jumlah Events</p>
                                <h4 class="card-title">{{ $eventJumlah }}</h4> <!-- Jumlah Events -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Pelatihan Selesai -->
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
                                <p class="card-category">Events Akan Hadir</p>
                                <h4 class="card-title">{{ $eventAkanhadir }}</h4>
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
                            <div class="icon-big text-center icon-warning bubble-shadow-small">
                                <i class="fas fa-calendar-week"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Events Berlangsung</p>
                                <h4 class="card-title">{{ $eventBerlangsung }}</h4>
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
                                <i class="fas fa-calendar-week"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Events Selesai</p>
                                <h4 class="card-title">{{ $eventSelesai }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="container py-4">
        <div class="row">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title text-light">Daftar Events</h4>
                
                <!-- Cek apakah pengguna login dan grupnya bukan 'Umum' -->
                @if (auth()->check() && auth()->user()->group->name !== 'Umum')
                    <a href="{{ route('events.create') }}" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i> Tambah Event Baru
                    </a>
                @endif
            </div>
        </div>

            
            <!-- Event Cards Loop -->
            @foreach($Events as $event)
                @php
                    // Tentukan status berdasarkan tanggal dan waktu_mulai
                    $now = now();
                    $tanggalEvent = \Carbon\Carbon::parse($event->tanggal);
                    $waktuMulai = \Carbon\Carbon::parse($event->tanggal . ' ' . $event->waktu_mulai); // Gabungkan tanggal dan waktu_mulai
                    $status = '';

                    if ($tanggalEvent->isToday()) { // Cek jika tanggal sama dengan hari ini
                        if ($now->greaterThanOrEqualTo($waktuMulai)) {
                            // Jika waktu sekarang >= waktu_mulai, status "berlangsung"
                            $status = 'berlangsung';
                        } elseif ($now->lessThan($waktuMulai)) {
                            // Jika waktu sekarang < waktu_mulai, status "akanhadir"
                            $status = 'akanhadir';
                        }
                    } elseif ($tanggalEvent->isFuture()) {
                        // Jika tanggal di masa depan
                        $status = 'akanhadir';
                    } else {
                        // Jika tanggal sudah lewat
                        $status = 'selesai';
                    }
                @endphp
                <div class="col-md-3 mb-4">
                    <div class="card h-80 shadow event-card position-relative">
                        <!-- Checkmark Animation -->
                        @if ($event->status === 'selesai')
                        <div class="checkmark-container">
                            <img src="{{ asset('assets/img/status/check.png') }}" 
                                class="checkmark-animation" 
                                alt="Selesai">
                        </div>
                        @endif

                        <!-- Image -->
                        @php
                            $photoPath = 'assets/img/eventsdkis/' . ($event->photo ?: 'default.png');
                            $photoUrl = file_exists(public_path($photoPath)) ? asset($photoPath) : asset('assets/img/eventsdkis/default.png');
                        @endphp
                        <img src="{{ $photoUrl }}" 
                            class="card-img-top img-fluid" 
                            alt="{{ $event->nama_event }}" 
                            style="height: 200px; width: auto; object-fit: cover; margin: 5px; border-radius: 8px;">

                    <!-- Card Body -->
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $event->nama_event }}</h5>
                        <p class="card-text text-muted">{{ $event->deskripsi_singkat }}</p>
                        <p>
                                <span class="badge rounded-pill 
                                    {{ $event->status === 'akanhadir' ? 'bg-primary text-white' : '' }}
                                    {{ $event->status === 'berlangsung' ? 'bg-warning text-white' : '' }}
                                    {{ $event->status === 'selesai' ? 'bg-danger text-white' : '' }}">
                                    {{ ucfirst($event->status) }}
                                </span>
                        </p>
                        <p class="text-muted mb-1">Tanggal: {{ $event->tanggal }}</p>
                        <p class="text-muted mb-1" style="font-size: 0.7rem;">
                        <strong>Created By:</strong> {{ $event->createdBy ? $event->createdBy->name : 'N/A' }} 
                        <span class="mx-2">|</span> 
                        <strong>Updated By:</strong> {{ $event->updatedBy ? $event->updatedBy->name : 'N/A' }}
                        </p>
                    </div>

                    <!-- Card Footer -->
                    <div class="card-footer d-flex justify-content-between shake">
                        

                        <!-- Cek apakah grup adalah 'Umum' untuk menampilkan tombol Show di tengah -->
                        @if (auth()->check() && auth()->user()->group->name === 'Umum')
                            <div class="d-flex justify-content-center w-100">
                                <a href="{{ route('events.show', $event->id_event) }}" class="btn btn-info btn-sm mx-auto">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </div>
                        @endif

                        <!-- Cek apakah grup bukan 'Umum' untuk menampilkan tombol Edit dan Delete -->
                        @if (auth()->check() && auth()->user()->group->name !== 'Umum')
                            <a href="{{ route('events.show', $event->id_event) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                            </a>
                            @if ($event->status !== 'selesai')
                            <a href="{{ route('events.edit', $event->id_event) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            @endif
                            @if (auth()->check() && auth()->user()->group->name === 'SuperAdmin')
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $event->id_event }}">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                            @endif
                        @endif
                    </div>


                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal{{ $event->id_event }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $event->id_event }}" aria-hidden="true">
                    <div class="modal-dialog text-dark">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $event->id_event }}">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-dark">
                                Apakah Anda yakin ingin menghapus event "{{ $event->nama_event }}"?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('events.destroy', $event->id_event) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Animasi CSS -->
<style>
    .checkmark-container {
        position: absolute;
        top: -10px;
        right: -10px;
        z-index: 1;
    }

    .checkmark-animation {
        width: 50px;
        height: 50px;
        animation: fadeInRotate 1.5s ease-in-out;

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

@endsection
