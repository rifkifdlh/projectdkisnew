    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="refresh" content="30>
    <title>DKIS by Rifki</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="{{ asset('assets/img/kaiadmin/favicon.png')}}"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{ asset('assets/css/fonts.min.css')}}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css')}}" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Tambahkan ini di bagian <head> untuk mengimpor jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css')}}" />
<style>
    .card {
        width: 100%;
    }

    .table {
        min-width: 100%;
    }

    .container-fluid {
        padding-left: 15px;
        padding-right: 15px;
    }
    
  .notif-message {
      margin-top: 10px;
      margin-bottom: 10px;
      padding: 10px;
      font-size: 14px;
    }

    .notif-time {
      font-size: 0.80em; /* Ukuran lebih kecil */
      color: #6c757d; /* Warna seperti placeholder (abu-abu) */
      margin-left: 5px; /* Beri jarak ke kiri dari pesan utama */
    }

    /* Pemisah garis bawah antar notifikasi */
    .notification-separator {
      border: 5;
      border-top: 5px solid #ddd; /* Warna garis bawah, bisa disesuaikan */
      margin: 5px 0; /* Jarak antara garis dan konten */
    }

    /* Efek hover hanya untuk cards atas halaman users */
    .hover-effect {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-effect:hover {
        transform: scale(1.05); /* Membesarkan kartu sedikit */
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* Bayangan lembut */
    }

    /* Efek hover hanya untuk halaman groups */
    .groups-page .group-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .groups-page .group-card:hover {
        transform: scale(1.05); /* Membesarkan sedikit kartu */
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* Menambahkan bayangan */
    }

    @keyframes shake {
    0% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    50% { transform: translateX(5px); }
    75% { transform: translateX(-5px); }
    100% { transform: translateX(0); }
  }

  .shake {
    animation: shake 0.5s;
  }
  
  /* Memberikan jarak pada header dan tombol */
.card-header {
    margin-bottom: 20px; /* Menambahkan jarak di bawah header */
}

.card-header .btn {
    margin-left: auto; /* Tombol berada di sebelah kanan */
}

/* Efek hover pada card events */
.event-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.event-card:hover {
    transform: scale(1.05); /* Membesarkan sedikit kartu */
    box-shadow: 0 8px 15px rgba(255, 255, 255, 0.5); /* Menambahkan bayangan warna putih */
}

/* Efek shake untuk elemen tertentu */
@keyframes shake {
    0% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    50% { transform: translateX(5px); }
    75% { transform: translateX(-5px); }
    100% { transform: translateX(0); }
}

.shake {
    animation: shake 0.5s;
}


.notif-scroll {
    max-height: 150px; /* Batas tinggi elemen */
    overflow-y: auto; /* Aktifkan scroll vertikal */
}


.scrollbar-outer::-webkit-scrollbar-thumb {
    background: #ccc; /* Warna slider scrollbar */
    border-radius: 3px; /* Sudut slider */
}

.scrollbar-outer::-webkit-scrollbar-track {
    background: #f1f1f1; /* Background track scrollbar */
}

.pelatihan-item {
    border-bottom: 1px solid #ddd;
    padding: 8px 0;
}

.pelatihan-item:last-child {
    border-bottom: none; /* Hilangkan garis bawah untuk item terakhir */
}


</style>
    @stack('styles')
