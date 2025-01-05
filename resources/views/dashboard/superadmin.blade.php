@extends('layouts.dashboard')

@section('title', 'Dashboard SuperAdmin')

@section('content')
    <!-- Bar Loading Overlay -->
    <div id="loadingBar" class="loading-bar d-none position-fixed top-0 start-0 w-0 bg-primary" style="height: 5px;"></div>

    <div class="container">
    <center>
        <h1 id='greeting'></h1>
        <p>Ini adalah halaman dashboard khusus untuk SuperAdmin.</p>
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
                                    <i class="fas fa-users text-info"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Jumlah User Online</p>
                                    <h4 class="card-title">{{ $usersOnline }}</h4>
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
                                    <i class="fas fa-user-check text-success"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">User Terdaftar</p>
                                    <h4 class="card-title">{{ $jumlahUserTerdaftar }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <!-- Jumlah Groups -->
             <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-globe text-secondary"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Jumlah Groups</p>
                                    <h4 class="card-title">{{ $jumlahGroups }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
                <!-- Jumlah Tempat -->
                <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-check-circle text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Aspirasi butuh Ditinjau</p>
                                    <h4 class="card-title">{{ $aspirasiDitinjau }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Jumlah Tempat Digunakan -->
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-warehouse text-secondary"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Tempat Digunakan</p>
                                    <h4 class="card-title">{{ $jumlahTempatDigunakan }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
            <!-- Jumlah Pelatihan Tersedia -->
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-child text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Pelatihan Berlangsung</p>
                                    <h4 class="card-title">{{ $jumlahPelatihanTersedia }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Jumlah Event Tersedia -->
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-calendar-week text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Event Tersedia</p>
                                    <h4 class="card-title">{{ $jumlahEventTersedia }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah login -->
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-briefcase text-primary"></i> <!-- Ikon -->
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">User Online</p>
                                    <p class="card">SuperAdmin: {{ $onlineUsersByGroup['SuperAdmin'] }}</p>
                                    <p class="card">Bidang: {{ $onlineUsersByGroup['Bidang'] }}</p>
                                    <p class="card">Umum: {{ $onlineUsersByGroup['Umum'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       

        <!-- Data SuperAdmin -->
        <div class="card">
            <div class="card-header">
                Data SuperAdmin
            </div>
            <div class="card-body">
                <p>Informasi lebih lanjut untuk SuperAdmin dapat ditambahkan di sini.</p>
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

    //Untuk Loading bar
    const loadingBar = document.getElementById('loadingBar');

    function showLoadingBar() {
        loadingBar.classList.remove('d-none');
        loadingBar.style.width = '0%';
        setTimeout(() => {
            loadingBar.style.transition = 'width 2s ease-in-out';
            loadingBar.style.width = '100%';
        }, 10); // Delay untuk memulai animasi setelah elemen ditampilkan
    }

    function hideLoadingBar() {
        setTimeout(() => {
            loadingBar.style.transition = 'width 0.5s ease-in-out';
            loadingBar.style.width = '0%';
            setTimeout(() => {
                loadingBar.classList.add('d-none');
            }, 500); // Tunggu sampai animasi selesai sebelum menyembunyikan elemen
        }, 2000); // Durasi penuh loading sebelum disembunyikan
    }

    // Contoh penggunaan:
    document.addEventListener('DOMContentLoaded', () => {
        // Tampilkan loading bar ketika memulai halaman
        showLoadingBar();

        // Sembunyikan loading bar setelah 2 detik
        hideLoadingBar();
    });
</script>
@endpush