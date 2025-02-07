<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Pelapor')</title>

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
    <link rel="stylesheet" href={{ asset('css/admin.css') }}>
</head>
<body>
    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3 styleNav">
        <nav class="navbar bg-light navbar-light">
            <a href="index.html" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary">PT Angkasa Pura I</h3>
            </a>
            <a href="{{ route('pelapor.reportPelapor') }}" style="text-decoration: none;color: inherit;">
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src={{ asset('img/user.png') }} alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        @auth
                            <h6 class="mb-0">{{ auth()->user()->nama_user }}</h6>
                            <span>{{ auth()->user()->role_user }}</span>
                        @else
                            <p>No user logged in</p>
                        @endauth
                    </div>
                </div>
            </a>
           
        </nav>
    </div>
    <!-- Sidebar End -->
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
        <a href="#" class="sidebar-toggler flex-shrink-0">
            <i class="fa fa-bars"></i>
        </a>
        <div class="navbar-nav align-items-center ms-auto">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img class="rounded-circle me-lg-2" src="{{ asset('img/user.png') }}" alt="" style="width: 40px; height: 40px;">
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                    <a href="{{ route('editProfil', ['id' => auth()->user()->id]) }}" class="dropdown-item">Edit Profile</a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item">Log Out</button>
                    </form>
                </div>
            </div>
            
        </div>
    </nav>
    <!-- Navbar End -->
    </div>

    {{--content--}}

    <div class="content">
        @yield('content')
    </div>

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