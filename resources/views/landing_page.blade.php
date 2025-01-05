@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')
<!-- Bar Loading Overlay -->
<div id="loadingBar" class="loading-bar d-none position-fixed top-0 start-0 w-0 bg-primary" style="height: 5px;"></div>

<div class="landing-page">
    <!-- Hero Section -->
    <div class="hero text-center py-5">
        <h1 class="display-3 fw-bold">Welcome to DKIS Events, Pelatihan dan Bimbingan TIK</h1>
        <p class="lead">Explore, ikuti dan menjadi bagian dari Aspirasi event kami.</p>
        @if(session('user_group') && in_array(session('user_group'), ['SuperAdmin', 'Umum', 'Bidang']))
            <!-- Tombol langsung menuju dashboard -->
            <a href="{{ route(session('user_group') === 'SuperAdmin' ? 'dashboard.superadmin' : (session('user_group') === 'Umum' ? 'dashboard.umum' : 'dashboard.bidang')) }}" 
            class="btn btn-get-started mt-4">
                Kembali ke Dashboard <i class="fas fa-arrow-right ms-2"></i>
            </a>
        @else
            <!-- Tombol Explore membuka modal -->
            <button class="btn btn-get-started mt-4" data-bs-toggle="modal" data-bs-target="#loginModal">
                Explore <i class="fas fa-arrow-right ms-2"></i>
            </button>
        @endif

       
    </div>

    <!-- Features Section -->
    <div class="feature-section mt-5 animate-on-load">
        <div class="feature-card">
            <img src="https://dkis.cirebonkota.go.id/wp-content/uploads/elementor/thumbs/112-e1729000002910-qwfgqakxp1m92ad1p7ymdnhwicfpwg0kgsjg1xgni8.png" alt="Feature 1">
            <h5>Cirebon Siaga 112</h5>
            <p>Nomor Tunggal Panggilan Darurat</p>
        </div>
        <div class="feature-card">
            <img src="https://dkis.cirebonkota.go.id/wp-content/uploads/elementor/thumbs/Cirebon-Satu-Data-qwfgqecagdrecq7l39l4nmjqvvx6r8fhtb5dz1b2tc.png" alt="Feature 2">
            <h5>Cirebon Satu Data</h5>
            <p>Portal Data Statistik Sektoral</p>
        </div>
        <div class="feature-card">
            <img src="https://dkis.cirebonkota.go.id/wp-content/uploads/elementor/thumbs/Cirebon-MELET-e1729000326414-qwfgqh5t0vv9bk3hmst0d3u4o1jaebqotp3uev6wao.png" alt="Feature 3">
            <h5>Cirebon Melek Internet</h5>
            <p>Penyediaan Fasilitas Wifi Gratis</p>
        </div>
        <div class="feature-card">
            <img src="https://dkis.cirebonkota.go.id/wp-content/uploads/elementor/thumbs/CSIRT-e1729000241317-qwfgqy2wfwif4jeww04alzkfcz7w8vluw0ul1uht6o.png" alt="Feature 4">
            <h5>CirebonKota-CSIRT</h5>
            <p>Tim Tanggap Insident Keamanan Siber</p>
        </div>
    </div>

    <!-- Our Location Section -->
    <section class="our-location mt-5 text-center">
        <h1 class="location">Lokasi Kami</h1>
        <p class="text-white">Kunjungi kami di kantor kami untuk mempelajari lebih lanjut tentang apa yang kami lakukan.</p>
        <div class="container mt-4">
            <div class="row g-4">
                <!-- Map 1 -->
                <div class="col-md-6">
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253602.21677430745!2d108.3183145819255!3d-6.704406952211668!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ee209bd53f649%3A0x8b85bec5b459e4f3!2sDinas%20Komunikasi%20Informasi%20Dan%20Statistik%20Kota%20Cirebon!5e0!3m2!1sen!2sid!4v1732320238439!5m2!1sen!2sid" 
                            width="100%" height="400" style="border:0;" allowfullscreen=""></iframe>
                    </div>
                    <p class="text-white mt-2">DKIS Bypass: Jalan Brigjend Dharsono No. 1, Kel. Sunyararagi, Kec. Kesambi, Kota Cirebon, 45135</p>
                </div>
                <!-- Map 2 -->
                <div class="col-md-6">
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253602.21677430745!2d108.3183145819255!3d-6.704406952211668!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f1d89f269093f%3A0xe9281bd67b6f3c25!2sDinas%20Komunikasi%2C%20Informatika%20dan%20Statistik%20Kota%20Cirebon!5e0!3m2!1sen!2sid!4v1732320426530!5m2!1sen!2sid" 
                            width="100%" height="400" style="border:0;" allowfullscreen=""></iframe>
                    </div>
                    <p class="text-white mt-2">DKIS Sudarsono: Jalan Dr. Sudarsono No. 40, Kel. Kesambi, Kec. Kesambi, Kota Cirebon, 45134</p>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <a href="{{ route('landing_page') }}" class="btn btn-link">
            <i class="fa fa-times"></i> </a>
            </div>
            <div class="modal-body">
                <!-- Tampilkan pesan error jika ada -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Tampilkan pesan sukses jika ada -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP/NIK</label>
                        <input type="text" name="nip" id="nip" class="form-control" placeholder="Masukkan NIP/NIK" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password" required>
                    </div>
                    <div class="mb-3">
                        <label for="group_id" class="form-label">Pilih Grup</label>
                        <select name="group_id" id="group_id" class="form-select" required>
                            <option disabled selected>Pilih Grup</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <p class="mt-3 text-center">
                    Belum punya akun? 
                    <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal">Daftar disini</a>.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Register -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Register</h5>
                <a href="{{ route('landing_page') }}" class="btn btn-link">
            <i class="fa fa-times"></i> </a>
            </div>
            <div class="modal-body">

            <!-- Tampilkan pesan error jika ada -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

            <!-- Tampilkan pesan sukses jika ada -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP/NIK</label>
                        <input type="text" name="nip" id="nip" class="form-control" placeholder="Masukkan NIP/NIK" value="{{ old('nip') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Konfirmasi password" required>
                    </div>
                    <input type="hidden" name="group_id" value="8">
                    <div class="mb-3">
                        <label for="photo" class="form-label">Foto Profil (Opsional)</label>
                        <input type="file" accept="image/*" name="photo" id="photo" class="form-control">
                        <small class="form-text text-muted">Unggah file dengan format jpeg,png,jpg,gif|max:2 MB</small>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </div>
                </form>
                <p class="mt-3 text-center">
                    Sudah punya akun? 
                    <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal">Login disini</a>.
                </p>
            </div>

        </div>
    </div>
</div>




<!-- JavaScript untuk mengambil grup berdasarkan NIP -->
@push('scripts')
<script>

    document.getElementById('nip').addEventListener('blur', function () {
        const nip = this.value;
        if (nip) {
            fetch(`{{ url('/get-groups') }}?nip=${nip}`)
                .then(response => response.json())
                .then(data => {
                    const groupSelect = document.getElementById('group_id');
                    groupSelect.innerHTML = ''; // Kosongkan dropdown

                    if (data.groups && data.groups.length) {
                        data.groups.forEach(group => {
                            const option = document.createElement('option');
                            option.value = group.id;
                            option.textContent = group.name;
                            groupSelect.appendChild(option);
                        });
                    } else {
                        groupSelect.innerHTML = '<option disabled selected>Grup tidak ditemukan</option>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching groups:', error);
                });
        }
    });

       

    document.addEventListener('DOMContentLoaded', function () {

     // Cek jika ada session openLoginModal
        if ({{ session('openLoginModal') ? 'true' : 'false' }}) {
            const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        }


        // Event listener untuk berpindah dari Register ke Login
        const registerToLoginLink = document.querySelector('#registerModal a[data-bs-target="#loginModal"]');
        
        if (registerToLoginLink) {
            registerToLoginLink.addEventListener('click', function (event) {
                // Ambil elemen modal
                const registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
                const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                
                // Tutup modal register terlebih dahulu
                registerModal.hide();
                
                // Tunggu sampai register modal benar-benar tertutup sebelum membuka login modal
                setTimeout(function() {
                    loginModal.show();
                }, 300); // Delay 300ms untuk memastikan modal benar-benar tertutup
            });
        }

        // Event listener untuk berpindah dari Login ke Register
        const loginToRegisterLink = document.querySelector('#loginModal a[data-bs-target="#registerModal"]');
        
        if (loginToRegisterLink) {
            loginToRegisterLink.addEventListener('click', function (event) {
                // Ambil elemen modal
                const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                const registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
                
                // Tutup modal login terlebih dahulu
                loginModal.hide();
                
                // Tunggu sampai login modal benar-benar tertutup sebelum membuka register modal
                setTimeout(function() {
                    registerModal.show();
                }, 300); // Delay 300ms untuk memastikan modal benar-benar tertutup
            });
        }
        
    });

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

@php
    // Force a 404 error if the route is invalid (for demonstration purposes)
    if (!in_array(request()->route()->getName(), ['landing_page', 'login', 'register'])) {
        abort(404);
    }
@endphp

@endsection
