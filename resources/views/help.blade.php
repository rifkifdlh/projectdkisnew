@extends('layouts.feat')

@section('content')
<!-- Bar Loading Overlay -->
<div id="loadingBar" class="loading-bar d-none position-fixed top-0 start-0 w-0 bg-primary" style="height: 5px;"></div>

<!-- Help Section -->
<section id="help" style="text-align: center;">
    <h2 style="font-size: 36px; font-weight: bold; margin-bottom: 20px; color: #ff8c00;">Help & Support</h2>
    <p style="font-size: 18px; line-height: 1.6; color: light; margin-bottom: 40px;">
        At <strong>DKIS</strong>, Lorem ipsum, dolor sit amet consectetur adipisicing elit. Illo dolores non, aliquam optio inventore consequatur in neque. Fugiat, sint officia ipsum, accusantium unde porro molestias nostrum illum repudiandae repellat aperiam.. 
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Suscipit dolores tempora, id ipsa fuga aspernatur fugiat tempore excepturi non nihil delectus nisi aliquid eaque, quisquam labore. Unde accusantium impedit quia!.
    </p>

    <!-- Help Topics -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; padding: 10px;">
        <div style="background-color: #39394d; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <i class="fas fa-question-circle" style="font-size: 50px; color: #ff8c00; margin-bottom: 20px;"></i>
            <h3 style="font-size: 24px; font-weight: bold; color: #fff;">MagangMagangMagang</h3>
            <p style="font-size: 16px; color: #ccc;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus saepe quaerat aliquid incidunt, placeat culpa facilis debitis reiciendis similique sit nulla! Unde ipsum debitis perferendis perspiciatis excepturi voluptate, corporis nesciunt..</p>
        </div>
        <div style="background-color: #39394d; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <i class="fas fa-bug" style="font-size: 50px; color: #ff8c00; margin-bottom: 20px;"></i>
            <h3 style="font-size: 24px; font-weight: bold; color: #fff;">MagangMagangMagang</h3>
            <p style="font-size: 16px; color: #ccc;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia fugiat eligendi molestias nam error deserunt cum assumenda! Doloremque molestias tempora at necessitatibus minima sint aliquam magnam. Debitis pariatur facere quae!.</p>
        </div>
        <div style="background-color: #39394d; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <i class="fas fa-headset" style="font-size: 50px; color: #ff8c00; margin-bottom: 20px;"></i>
            <h3 style="font-size: 24px; font-weight: bold; color: #fff;">Contact Support</h3>
            <p style="font-size: 16px; color: #ccc;">
                For further assistance, feel free to contact our 
                @if(Auth::check()) 
                    <a href="question_form" style="color: #ff8c00; text-decoration: underline;">customer DKIS</a>
                @else 
                    <a href="{{ route('landing_page') }}" style="color: #ff8c00; text-decoration: underline;">customer DKIS</a>
                @endif
                We are here to help you 24/7.
            </p>
        </div>

        <div style="background-color: #39394d; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <i class="fas fa-comments" style="font-size: 50px; color: #ff8c00; margin-bottom: 20px;"></i>
            <h3 style="font-size: 24px; font-weight: bold; color: #fff;">MagangMagangMagang</h3>
            <p style="font-size: 16px; color: #ccc;">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Atque odit accusamus voluptas minima esse. Labore quisquam, nobis nam consequuntur cum delectus ratione laudantium quam officiis ad sunt! Quibusdam, dolore cupiditate..</p>
        </div>
    </div>

    
</section>

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

@endsection
