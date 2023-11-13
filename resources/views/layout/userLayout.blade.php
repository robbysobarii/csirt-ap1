<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin')</title>
    <!-- Favicon -->
    <link href={{ asset('img/favicon.ico') }} rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href={{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }} rel="stylesheet">
    <link href={{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }} rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href={{ asset('css/bootstrap.min.css') }} rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href={{ asset('css/style.css') }} rel="stylesheet">

    {{-- css global ours --}}
    <link rel="stylesheet" href={{ asset('css/user.css') }}>
</head>
<body>
    
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-light navbar-light fixed-top mr-4 py-0 navbarBG">
        <div class="navbar-logo">
            <img src="{{ asset('img/logo.svg') }}" alt="logo">
        </div>
        <div class="navbar-nav fiturNav">
            <div class="fitur">
                <p>Beranda</p>
            </div>
            <!-- Add other menu items here -->
            <div class="fitur">
                <p>Tentang Kami</p>
            </div>
            <div class="fitur">
                <p>RFC 2350</p>
            </div>
            <div class="fitur">
                <p>Layanan</p>
            </div>
            <div class="fitur">
                <p>Event</p>
            </div>
            <div class="fitur">
                <p>Hubungi Kami</p>
            </div>
            <div class="fitur">
                <p>Laporkan Insiden</p>
            </div>
            
        </div>
    </nav>
    <!-- Navbar End -->
    </div>

    {{--content--}}

    @yield('content')

    @stack('scripts')
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src={{ asset('lib/chart/chart.min.js') }}></script>
    <script src={{ asset('lib/easing/easing.min.js') }}></script>
    <script src={{ asset('lib/waypoints/waypoints.min.js') }}></script>
    <script src={{ asset('lib/owlcarousel/owl.carousel.min.js') }}></script>
    <script src={{ asset('lib/tempusdominus/js/moment.min.js') }}></script>
    <script src={{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}></script>
    <script src={{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}></script>

    <!-- Template Javascript -->
    <script src={{ asset('js/main.js') }}></script>
</body>
</html>