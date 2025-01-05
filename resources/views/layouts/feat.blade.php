<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <style>
    body {
        position: relative;
        background: url('{{ asset('assets/img/backgroundauth.png') }}') no-repeat center center fixed;
        background-size: cover;
        color: #fff;
    }
    /* Gradasi pada teks Login */
    .card-title {
        background: linear-gradient(45deg, #ff6b6b, #f7d794); /* Gradasi warna */
        -webkit-background-clip: text; /* Menggunakan gradasi hanya untuk teks */
        color: transparent; /* Membuat teks transparan agar gradasi terlihat */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8); /* Memberikan bayangan halus */
        transition: color 0.3s ease, text-shadow 0.3s ease;
    }


    /* Overlay with darker effect */
    body::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5); /* Adjust the opacity (0.5 = 50% dark) */
        z-index: -1; /* Place it behind the content */
    }

    .centered-content {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 20px;
        box-sizing: border-box;
        position: relative; /* Ensure content stays above the overlay */
        z-index: 1;
    }

    .content-container {
        width: 100%;
        max-width: 800px;
        background-color: rgba(255, 255, 255, 0.8); /* Slightly more opaque for better readability */
        color: #000;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Styling dan bayangan untuk teks Login */
    /* Membatasi lebar inputan */
    .form-group input, .form-group select {
        max-width: 400px; /* Menyesuaikan panjang input */
        margin: 0 auto; /* Membuat inputan rata tengah */
        display: block; /* Membuat input menjadi blok agar tengah */
    }

    /* Membuat tombol login lebih kompak dan bulat */
    .btn-primary {
        border-radius: 30px; /* Memberikan efek rounded pada tombol */
        padding: 10px 20px; /* Menyesuaikan ukuran tombol */
        font-size: 1rem; /* Ukuran font tombol */
        max-width: 250px; /* Tombol tidak sepanjang form */
        margin: 0 auto; /* Menjaga tombol tetap rata tengah */
        display: block; /* Membuat tombol menjadi blok agar tengah */
    }

    /* Memastikan form tidak terlalu panjang */
    .form-container {
        width: 100%;
        max-width: 800px; /* Membatasi lebar form */
        margin: 0 auto; /* Form tetap rata tengah */
    }

   /* Animasi fade-in pada form login */
    .form-container {
        opacity: 0;
        animation: formFadeIn 1.5s ease-out forwards; /* Menambahkan animasi pada form */
    }

    /* Keyframes untuk animasi fade-in pada form */
    @keyframes formFadeIn {
        0% {
            opacity: 0;
            transform: translateY(20px); /* Form bergerak dari bawah */
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Styling teks Login dengan gradient dan ukuran lebih besar */
    .card-title {
        background: linear-gradient(45deg, #ff6b6b, #f7d794); /* Gradasi warna */
        -webkit-background-clip: text; /* Gradient hanya pada teks */
        color: transparent; /* Membuat warna teks transparan untuk menunjukkan gradient */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8); /* Bayangan halus pada teks */
        font-size: 2.5rem; /* Membuat ukuran teks lebih besar */
        transition: color 0.3s ease, text-shadow 0.3s ease;
    }



</style>

</head>
<body>
    

    <!-- Start Page Content Wrapper -->
    <div class="page-content centered-content">
        <div class="content-container">
            @yield('content')
        </div>
    </div>
    <!-- End Page Content-->

    <!-- Footer Start -->
    <footer class="footer" style="background-color: #343a40; color: #fff; padding: 5px 6;">
        @include('includes.footer')
    </footer>
    <!-- End Footer -->

    <!-- Core JS Files -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/core/popper.min.js')}}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js')}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    @stack('styles')
    @stack('scripts')
    


</body>
</html>
