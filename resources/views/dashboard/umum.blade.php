@extends('layouts.dashboard')

@section('title', 'Dashboard Umum')

@section('content')
    <div class="container">
        <center>
            <h1 id='greeting'></h1>
            <p>Ini adalah halaman dashboard khusus untuk Umum.</p>
        </center>
        <!-- Section Title -->
        <div class="row">
            <div class="col-12">
                <h3 class="mb-4">Statistik Utama</h3>
            </div>
        </div>
        
        <!-- Row Card No Padding -->
        <div class="row row-card-no-pd">
            <!-- Jumlah User Online -->
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-child text-info"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Jumlah Pelatihan Tersedia</p>
                                    <h4 class="card-title">{{ $jumlahPelatihanTersedia }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah User Terdaftar -->
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-user-plus text-success"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Pelatihan Yang Di Ikuti</p>
                                    <h4 class="card-title">{{ $jumlahPelatihan }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aspirasi Yang Diajukan -->
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-bullhorn text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Aspirasi Yang Diajukan</p>
                                    <h4 class="card-title">{{ $jumlahAspirasiSaya }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aspirasi Diterima -->
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
                                    <p class="card-category">Aspirasi Disetujui</p>
                                    <h4 class="card-title">{{ $jumlahAspirasiDisetujui }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header">
                Data Umum
            </div>
            <div class="card-body">
                <p>Informasi lebih lanjut untuk grup Umum dapat ditambahkan di sini.</p>
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