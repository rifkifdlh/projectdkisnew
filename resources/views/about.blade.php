@extends('layouts.feat')

@section('content')
<!-- Bar Loading Overlay -->
<div id="loadingBar" class="loading-bar d-none position-fixed top-0 start-0 w-0 bg-primary" style="height: 5px;"></div>

<!-- About Section -->
<section id="about" style="text-align: center;">
    <h2 style="font-size: 36px; font-weight: bold; margin-bottom: 20px; color: #ff8c00;">About DKIS</h2>
    <p style="font-size: 18px; line-height: 1.6; color: light; margin-bottom: 40px;">
        Welcome to <strong>DKIS Pelatihan Teknis dan Bimbingan TIK</strong>-Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, magnam illum? Voluptate natus culpa saepe veniam quia cum, aut officiis eligendi deserunt corrupti cumque doloribus facere quibusdam doloremque enim? Ipsa?
    </p>

    <!-- Features -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; padding: 10px;">
        <div style="background-color: #39394d; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <i class="fas fa-gamepad" style="font-size: 50px; color: #ff8c00; margin-bottom: 20px;"></i>
            <h3 style="font-size: 24px; font-weight: bold; color: #fff;">Magang</h3>
            <p style="font-size: 16px; color: #ccc;">MagangMagangMagangMagangMagangMagangMagangMagang.</p>
        </div>
        <div style="background-color: #39394d; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <i class="fas fa-trophy" style="font-size: 50px; color: #ff8c00; margin-bottom: 20px;"></i>
            <h3 style="font-size: 24px; font-weight: bold; color: #fff;">Magang</h3>
            <p style="font-size: 16px; color: #ccc;">MagangMagangMagangMagangMagangMagangMagangMagang.</p>
        </div>
        <div style="background-color: #39394d; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <i class="fas fa-child" style="font-size: 50px; color: #ff8c00; margin-bottom: 20px;"></i>
            <h3 style="font-size: 24px; font-weight: bold; color: #fff;">Magang</h3>
            <p style="font-size: 16px; color: #ccc;">MagangMagangMagangMagangMagangMagangMagangMagang.</p>
        </div>
        <div style="background-color: #39394d; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <i class="fas fa-map-marker-alt" style="font-size: 50px; color: #ff8c00; margin-bottom: 20px;"></i>
            <h3 style="font-size: 24px; font-weight: bold; color: #fff;">Our Location</h3>
            <div style="margin-top: 10px;">
                
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12258.540909048392!2d108.52122455835338!3d-6.726263899332506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ee209bd53f649%3A0x8b85bec5b459e4f3!2sDinas%20Komunikasi%20Informasi%20Dan%20Statistik%20Kota%20Cirebon!5e1!3m2!1sen!2sid!4v1731900393700!5m2!1sen!2sid" 
                    width="100%" height="200" style="border:0; border-radius: 8px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>

    <div style="margin-top: 40px;">
        <a href="{{ Auth::check() ? 
                (Auth::user()->group->name === 'SuperAdmin' ? route('dashboard.superadmin') : 
                (Auth::user()->group->name === 'Umum' ? route('dashboard.umum') : 
                (in_array(Auth::user()->group->name, ['E-Government', 'ITIK', 'Persandian', 'PIKP', 'Statistik', 'Sekretariat']) ? route('dashboard.bidang') : '#'))) 
                : route('landing_page') }}" 
        class="btn btn-primary" 
        style="background-color: #ff8c00; padding: 12px 20px; border-radius: 5px; color: #fff; text-decoration: none; font-size: 18px;">
            Explore DKIS
        </a>
    </div>


@push('scripts')
<script>
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

</section>
@endsection
