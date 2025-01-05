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
        
        .page-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }


        .btn-primary {
            border-radius: 30px;
        }
    </style>
</head>
<body>
    <div class="page-content">
        <div class="content-container">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
</body>
</html>
