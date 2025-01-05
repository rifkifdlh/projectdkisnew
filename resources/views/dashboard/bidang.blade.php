@extends('layouts.dashboard')

@section('title', 'Dashboard Bidang')

@section('content')
    <div class="container">
        <center>
            <h1 id='greeting'></h1>
            <p>Ini adalah halaman dashboard khusus untuk Bidang {{ Auth::user()->group->name }}.</p>
        </center>

        <!-- Row Card No Padding -->
        <div class="row row-card-no-pd">
            <!-- Jumlah aspirasi di tinjau -->
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-eye text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Jumlah Aspirasi Ditinjau</p>
                                    <h4 class="card-title">{{ $jumlahaspirasiDitinjau }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah aspirasi disetujui -->
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-thumbs-up text-success"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Jumlah Aspirasi Disetujui</p>
                                    <h4 class="card-title">{{ $jumlahaspirasiDisetujui }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah aspirasi di tolak -->
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-thumbs-down text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Jumlah Aspirasi Ditolak</p>
                                    <h4 class="card-title">{{ $jumlahaspirasiDitolak }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
        <div class="card">
            <div class="card-header">
                Data Bidang
            </div>
            <div class="card-body">
                <p>Informasi lebih lanjut untuk bidang {{ Auth::user()->group->name }} dapat ditambahkan di sini.</p>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
<script>
    const hours = new Date().getHours();
    let greeting;

    if (hours >= 5 && hours < 12) {
        greeting = 'Selamat Pagi';
    } else if (hours >= 12 && hours < 15) {
        greeting = 'Selamat Siang';
    } else if (hours >= 15 && hours < 18) {
        greeting = 'Selamat Sore';
    } else {
        greeting = 'Selamat Malam';
    }

    document.getElementById('greeting').innerText = greeting + ", {{ Auth::user()->name }}!";
</script>
@endpush