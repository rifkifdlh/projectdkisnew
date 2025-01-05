<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DKIS by Rifki</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
   
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Base Styles */
        body {
            background-color: #121212; /* Dark background */
            color: #ffffff; /* Light text color */
            font-family: Arial, sans-serif;
        }

        .hero h1 {
            font-size: 3rem; /* Ukuran besar */
            font-weight: bold;
            background: linear-gradient(45deg, #ff6b6b, #f7d794); /* Gradasi warna */
            -webkit-background-clip: text; /* Hanya klip ke teks */
            -webkit-text-fill-color: transparent; /* Buat latar belakang terlihat */
            background-clip: text;
            text-fill-color: transparent;
        }


        /* Buttons */
        .btn {
            font-weight: 600;
        }
        .btn:hover {
            color: #ffffff;
        }
        .btn-get-started {
            background: linear-gradient(45deg, #ff6b6b, #f7d794);
            color: #fff;
            padding: 12px 20px;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-get-started:hover {
            background: linear-gradient(45deg, #f7d794, #ff6b6b);
            transform: scale(1.05);
        }

        /* General Section Styling */
        .hero h1 {
            color: #ffffff;
        }
        .hero p {
            color: #cccccc;
        }

        /* Feature Section */
        .row .col img {
            width: 150px;
            border-radius: 50%;
        }
        .row .col h5 {
            color: #ffffff;
        }
        .row .col p {
            color: #cccccc;
        }
        /* Feature Section Styling */
        /* Feature Section as Cards */
        .feature-section {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* 4 kolom sejajar */
            gap: 20px; /* Jarak antar kartu */
            padding: 20px;
        }

        .feature-card {
            background-color: #1f1f1f; /* Warna dasar kartu */
            color: #ffffff; /* Warna teks */
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden; /* Supaya gambar tidak keluar dari radius */
            text-align: center;
            padding: 20px;
        }

        .feature-card img {
            width: 100%;
            max-width: 120px; /* Ukuran maksimal gambar */
            margin: 0 auto 15px; /* Tengah dan beri jarak bawah */
            border-radius: 50%; /* Bikin gambar bulat */
            transition: transform 0.3s ease;
        }

        .feature-card h5 {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .feature-card p {
            font-size: 14px;
            color: #cccccc;
        }

        .feature-card:hover {
            transform: translateY(-10px); /* Efek hover mengangkat */
            box-shadow: 0 12px 24px rgba(255, 255, 255, 0.3);
        }

        .feature-card:hover img {
            transform: scale(1.1); /* Efek gambar membesar */
        }

        /* Responsiveness */
        @media (max-width: 992px) {
            .feature-section {
                grid-template-columns: repeat(2, 1fr); /* 2 kolom untuk tablet */
            }
        }

        @media (max-width: 576px) {
            .feature-section {
                grid-template-columns: 1fr; /* 1 kolom untuk ponsel */
            }
        }


        /* Animasi muncul */
        .animate-on-load .col {
            opacity: 0;
            transform: translateY(50px); /* Mulai dari posisi lebih rendah */
            transition: opacity 1s ease, transform 1s ease; /* Animasi memudar dan bergerak ke atas */
        }

        .animate-on-load .col.show {
            opacity: 1;
            transform: translateY(0); /* Posisi akhir */
        }

        



        /* Location Section */
        .location {
            font-size: 2.5rem; /* Ukuran teks */
            font-weight: bold; /* Ketebalan teks */
            background: linear-gradient(45deg, #ff6b6b, #f7d794); /* Gradasi warna */
            -webkit-background-clip: text; /* Menerapkan gradasi hanya pada teks */
            -webkit-text-fill-color: transparent; /* Membuat teks transparan sehingga gradasi terlihat */
        }
        .location p {
            color: #cccccc;
        }
        .map-container iframe {
            border-radius: 12px;
            overflow: hidden;
        }

        .modal-title {
            text-align: center; /* Pusatkan teks secara horizontal */
            margin: 0 auto; /* Hilangkan margin default */
            width: 100%; /* Pastikan judul menggunakan seluruh lebar modal */
            font-weight: bold; /* Opsional: tambahkan ketebalan untuk penekanan */
        }

        .modal-content {
            background-color: rgba(255, 255, 255, 0.6); /* Putih dengan 90% opasitas */
            color: #343a40; /* Warna teks default */
            border-radius: 10px; /* Tambahkan sedikit pembulatan untuk tampilan modern */
            backdrop-filter: blur(10px); /* Opsional: Tambahkan efek blur */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Tambahkan bayangan untuk estetika */
        }

        .modal-backdrop {
    z-index: 1050 !important; /* Pastikan backdrop modal tidak menghalangi halaman */
}



        .form-label {
            color: #343a40;
            font-weight: 500;
        }

    /* Warna teks di footer modal */
        .login-footer {
            color: #343a40; /* Abu-abu gelap */
            font-weight: 500; /* Sedikit tebal untuk keterbacaan */
        }

        .login-footer a {
            text-decoration: underline; /* Garis bawah */
            color: #007bff; /* Warna biru kontras */
            font-weight: bold; /* Tambahkan ketebalan */
        }



    </style>
</head>
<body>
   

    <!-- Main Content -->
    <div class="container my-4">
        @yield('content')
    </div>
        <!-- Footer Start -->
        <footer class="footer" style="background-color: #343a40; color: #fff; padding: 5px 6;">
        @include('includes.footer')
        </footer>
        <!-- End Footer --> 


    <!--   Core JS Files   -->
    <script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js')}}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js')}}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js')}}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js')}}"></script>

    <!-- Datatables -->
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js')}}"></script>

    <!-- Bootstrap Notify -->
    <!--<script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script> -->

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/world.js')}}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/js/kaiadmin.min.js')}}"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets/js/setting-demo.js')}}"></script>
    <script src="{{ asset('assets/js/demo.js')}}"></script>
<!-- Include Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


    <script>
        window.addEventListener('load', function () {
            const elementsToAnimate = document.querySelectorAll('.animate-on-load');
            elementsToAnimate.forEach(function (element) {
                element.classList.add('show');
            });
        });
    </script>

@stack('styles')
@stack('scripts')
</body>
</html>
