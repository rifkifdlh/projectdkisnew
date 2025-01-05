@extends('layouts.error')

@section('content')
<!-- Bar Loading Overlay -->
<div id="loadingBar" class="loading-bar d-none position-fixed top-0 start-0 w-0 bg-primary" style="height: 5px;"></div>

<div class="card text-center">
    <div class="card-header">
        <h2 class="card-title">400</h2>   
    </div>
    <div class="card-body">
        <h5 class="card-title">Bad Request</h5>
        <p class="card-text">The server could not process your request. Please try again later.</p>
        <div>
            <button id="backButton" class="btn btn-primary">
                Kembali ke Halaman Utama
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const backButton = document.getElementById('backButton');
        const loadingBar = document.getElementById('loadingBar');

        backButton.addEventListener('click', function () {
            // Tampilkan bar loading
            loadingBar.classList.remove('d-none');
            
            // Animasi bar loading
            let width = 0;
            const interval = setInterval(() => {
                if (width >= 100) {
                    clearInterval(interval);

                    @if(Auth::check())
                        // Arahkan ke dashboard berdasarkan grup pengguna
                        @php
                            $group = Auth::user()->group->name;
                            $dashboardRoute = match ($group) {
                                'SuperAdmin' => route('dashboard.superadmin'),
                                'Umum' => route('dashboard.umum'),
                                'E-Government', 'ITIK', 'Persandian', 'PIKP', 'Statistik', 'Sekretariat' => route('dashboard.bidang'),
                                default => '#',
                            };
                        @endphp
                        window.location.href = "{{ $dashboardRoute }}";
                    @else
                        // Kembali ke halaman sebelumnya jika tidak login
                        setTimeout(() => history.back(), 500);
                    @endif
                } else {
                    width += 2; // Tingkat kenaikan progress
                    loadingBar.style.width = width + '%';
                }
            }, 15); // Kecepatan animasi
        });
    });
</script>
@endsection
