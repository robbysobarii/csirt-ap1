<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin')</title>
    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    {{-- css global ours --}}
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <style>
        body {
            overflow-x: hidden; 
        }

        .navbar-logo img {
            max-width: 100%;
            height: auto;
        }
        
        @media (max-width: 900px) {
            body {
                font-size: 14px;
            }
            .highFooter,
            .highFooter a,
            .highFooter p,
            .highFooter h6 {
                font-size: 12px; 
            }
            .icon{
                font-size: 16px;
            }
            .kiriFooter{
                width: 60%
            }
            .satu{
                padding-right: 30px;
                width: 100%;
            }
            .dua{
                padding-right: 20px;
                width: 100%;
            }
            .contentBerita p, .contentBerita h6{
                font-size: 13px
            }
            .galeriWidth{
                width: 90%;
                font-size: 12px
            }
            .ahref{
                max-height: 100px;
            }
            .galeriWidth img{
                min-height: 100px;
                width: 100%
            }
            .layanDrop{
                text-align: left;
                padding: 0;
                margin: 0;
                width: 100%
                
            }
            .fiturMenu  {
                font-size: 11px
            }
        }


    </style>
</head>

<body>

   <!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-light navbar-light fixed-top mr-4 py-0 navbarBG">
    <div class="navbar-logo" style="width: 40%;margin: 0;padding: 0">
        <img src="{{ asset('/img/logo.svg') }}" alt="logo" style="width: 100%;">
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" >
        <span class="navbar-toggler-icon" ></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <div class="navbar-nav">
            <a class="nav-link fiturMenu fitur{{ $berandaActive ?? '' }}" href="{{ route('user.beranda')}}">BERANDA</a>

            <li class="nav-item dropdown">
                <a class="nav-link fiturMenu dropdown-toggle fitur{{ $tentangKamiActive ?? '' }}" href="#" id="tentangKamiDropdown"
                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Tentang Kami
                </a>
                <div class="dropdown-menu" aria-labelledby="tentangKamiDropdown">
                    <a class="dropdown-item fiturMenu" href="{{ route('tentangKami.profil')}}">Profil</a>
                    <a class="dropdown-item fiturMenu" href="{{ route('tentangKami.visiMisi')}}">Visi Misi</a>
                    <a class="dropdown-item fiturMenu" href="{{ route('tentangKami.struktur')}}">Struktur Organisasi</a>
                </div>
            </li>

            <a class="nav-link fiturMenu fitur{{ $rfcActive ?? '' }}" href="{{ route('user.rfc')}}">RFC 2350</a>

            <li class="nav-item dropdown layanDrop" >
                <a class="nav-link fiturMenu dropdown-toggle fitur{{ $layananActive ?? '' }}" href="#" id="layananDropdown"
                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    LAYANAN
                </a>
                <div class="dropdown-menu" aria-labelledby="layananDropdown">
                    <a class="dropdown-item fiturMenu" href="{{ route('layanan.aduanSiber')}}">Aduan Siber</a>
                    <a class="dropdown-item fiturMenu" href="{{ route('layanan.layananVA')}}">Layanan VA</a>
                    <a class="dropdown-item fiturMenu" href="{{ route('layanan.panduan')}}">Panduan Teknis</a>
                </div>
            </li>

            <a class="nav-link fitur{{ $eventActive ?? '' }}" href="{{ route('user.event')}}">Event</a>
            <a class="nav-link fitur{{ $hubungiKamiActive ?? '' }}" href="{{ route('user.hubungiKami')}}">Hubungi Kami</a>
            <a class="nav-link fitur{{ $laporkanInsidenActive ?? '' }}" href="{{ route('user.laporkanInsiden')}}">Laporkan Insiden</a>
        </div>
    </div>
</nav>
<!-- Navbar End -->



    {{-- content --}}
    <div class="bg">
        
        @yield('content')
    </div>

  <!-- Footer Start -->
<div class="footer">
    <div class="highFooter" style="display: flex; justify-content: space-between; padding: 30px;">
        <div class="kiriFooter" style="border-right: 1px solid #fff; width: 50%; padding-inline: 40px; ">
            <div class="fiturKiri" style="display: flex; justify-content: space-between; padding-right: 30px">
                <div class="satu" style=" padding-left: 50px; font-size: 14px; padding-top: 20px;">
                    <h6 style="color: white; margin-bottom: 20px">TENTANG KAMI</h6>
                    <a href="{{ route('tentangKami.profil')}}" style="color: white; text-decoration: none; display: block; margin-bottom: 5px;">Profil</a>
                    <a href="{{ route('tentangKami.visiMisi')}}" style="color: white; text-decoration: none; display: block; margin-bottom: 5px;">Visi Misi</a>
                    <a href="{{ route('tentangKami.struktur')}}" style="color: white; text-decoration: none; display: block; margin-bottom: 5px;">Struktur Organisasi</a>
        
                </div>
                
                <div class="dua" style="font-size: 14px; padding-top: 20px; ">
                    <h6 style="color: white;margin-bottom: 20px">LAYANAN</h6>
                    <a href="{{ route('layanan.aduanSiber')}}" style="color: white; text-decoration: none; display: block; margin-bottom: 5px;" >Aduan Siber</a>
                    <a href="{{ route('layanan.layananVA')}}" style="color: white; text-decoration: none; display: block; margin-bottom: 5px;" >Layanan VA</a>
                    <a href="{{ route('layanan.panduan')}}" style="color: white; text-decoration: none; display: block; margin-bottom: 5px;" >Panduan Teknis</a>
                </div>
            </div>
    
            <!-- Social Media Icons -->
            <div style="margin-top: 20px; margin-bottom: 20px; display: flex; padding-left: 50px" class="social">
                <a href="#" style="color: white; text-decoration: none; margin-right: 10px; font-size: 20px;" ><i class="icon fab fa-facebook"></i></a>
                <a href="#" style="color: white; text-decoration: none; margin-right: 10px; font-size: 20px;" ><i class="icon fab fa-instagram"></i></a>
                <a href="#" style="color: white; text-decoration: none; margin-right: 10px; font-size: 20px;" ><i class="icon fab fa-twitter"></i></a>
                <a href="#" style="color: white; text-decoration: none; font-size: 20px;" ><i class="icon fab fa-youtube"></i></a>
            </div>
        </div>

        <div class="tiga" style="width: 50%; padding-left: 50px; font-size: 14px;margin-bottom: 20px">
            <img src="/img/foot_logo.svg" alt="Logo">
            <h6 style="color: white; padding-top: 30px">PT Angkasa Pura I</h6>
            <p style="padding: 0;margin: 0;">Kota Baru Bandar Kemayoran Blok B12 Kav.2 Jakarta Pusat, DKI Jakarta - Indonesia</p>
            <p style="padding: 0;margin: 0;">Telp. +62-21 6541961</p>
            <p style="padding: 0;margin: 0;">Faks. +62-21 6541514</p>
        </div>
        <div class="empat" style="width: 60%; padding-left: 60px; display: flex; flex-direction: column; justify-content: center;">

            <!-- Contact Center 172 -->
            <div style="display: flex; align-items: center; margin-bottom: 20px">
                <img src="/img/call_foot.svg" alt="Call Footer">
                <p style="margin: 10px;">Contact Center 172</p>
            </div>
        
            <!-- Informasi, Saran dan Keluhan -->
            <div style="display: flex; align-items: center;">
                <img src="/img/write_foot.svg" alt="Write Footer">
                <p style="margin: 10px;">Informasi, Saran dan Keluhan: cc172@ap1.co.id</p>
            </div>
        </div>
    </div>
    <div class="lowerFooter" >
        <p>© Copyright 2023 PT Angkasa Pura I</p>
    </div>
</div>
<!-- Footer End -->


    @stack('scripts')
    <!-- JavaScript Libraries -->
    <!-- Bootstrap JavaScript and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
