@extends('layout.userLayout')
@section('title','Beranda')
@section('content')

<div id="carouselExample" class="carousel slide position-relative">
    <div class="carousel-inner" style="max-height: 600px">
        @foreach ($carousels as $key => $carousel)
            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $carousel->image_path) }}" class="d-block w-100" alt="carousel">
                <div class="overlay-text">
                    <div class="text-container px-md-5 px-lg-5 px">
                        <h1 class="text-black">{{ $carousel->heading_caption }}</h1>
                        <p class="text-black">{{ $carousel->caption }}</p>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- Container for ARTIKEL DAN BERITA -->
        <div class="containerAJudul w-100 py-3 position-absolute px-5">
            <h4>| ARTIKEL DAN BERITA</h4>
            <div class="search-container mr-10">
                <input type="text" placeholder="Search..." class="search-bar searchCol px-4 py-1">
                <i class="fas fa-search search-icon"></i>
            </div>
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<div class="container">
    <div class="head containerContent">
        <div class="judul">
            <h2>INFO SIBER</h2>
            <p>Terakhir update: 20/10/2023</p>
        </div>
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Pilih Menu
            </button>
            <hr>
            <ul class="dropdown-menu dropdown-menu-light">
                <li><a class="dropdown-item active" href="#">Berita</a></li>
                <li><a class="dropdown-item" href="#">Artikel</a></li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="main">
        <div class="kiri" style="width: 70%; word-wrap: break-word;">
            @if($content->count() > 0)
                @foreach($content->take(2) as $item)
                    <div>
                        <div style="text-align: center">
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="content" style="max-height: 320px; margin-block: 30px">
                        </div>
                        <h3>{{ $item->judul }}</h3>
                        <p style="text-align: justify; padding: 5px">{{ \Illuminate\Support\Str::limit($item->isi_konten, 700) }}</p>
                        <a href="{{ route('berita', ['id' => $item->id]) }}" class="selengkap">> Selengkapnya</a>
                    </div>
                @endforeach
            @else
                <p>No content available</p>
            @endif
        </div>

        <div class="kanan" style="width: 30%;">
            @foreach($content as $index => $item)
                @if($index < 5 && $index >= 2) <!-- Change condition to display only the first three items -->
                    <div class="contentBerita" style="margin:auto; word-wrap: break-word;">
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="content" style="width: 100%; height: 150px; object-fit: cover;">
                        <h5 style="text-align: justify;" class="pt-2">{{ $item->judul }}</h5>
                        <p style="text-align: justify; padding: 5px">{{ \Illuminate\Support\Str::limit($item->isi_konten, 100) }}</p>
                        <div style="text-align: left">
                            <a href="{{ route('berita', ['id' => $item->id]) }}" class="selengkapKanan">> Selengkapnya</a>
                        </div>
                    </div>
                @endif
            @endforeach
        
            @if($content->count() > 3)
                <div class="lihatSemua">
                    <a href="{{ route('daftarBerita') }}" >Lihat Semua</a>
                </div>
            @endif
        </div>
    </div>
        
    
</div>
<div class="galery mb-10">
    <img src="/img/galeryHead.svg" class="w-100 mb-5" alt="Heading">
    <div id="galleryCarousel" class="carousel">
        <div class="carousel-inner-galery">
            @foreach ($galleries as $gallery)
                <div class="carousel-item-galery mx-4">
                    <a href="{{ route('galeri', ['id' => $gallery->id]) }}" style="display: block; height: 100%;">
                        <img src="{{ asset('storage/' . $gallery->gambar) }}" class="d-block w-100" alt="{{ $gallery->judul }}">
                        <div class="bgGalery">
                            <p class="text-white">{{ $gallery->caption }}</p>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let currentIndex = 0;
        const items = document.querySelectorAll('.carousel-item-galery');
        const visibleItems = 3;

        function updateCarousel() {
            const translateValue = -currentIndex * (100 / visibleItems) + '%';
            document.querySelector('.carousel-inner-galery').style.transform = 'translateX(' + translateValue + ')';
        }

        function showNext() {
            if (currentIndex < items.length - visibleItems) {
                currentIndex++;
                updateCarousel();
            }
        }

        function showPrev() {
            if (currentIndex > 0) {
                currentIndex--;
                updateCarousel();
            }
        }

        // Initialize currentIndex based on the number of visible items
        currentIndex = Math.min(currentIndex, items.length - visibleItems);

        // Show the initial state of the carousel
        updateCarousel();

        document.querySelector('.carousel-control-prev').addEventListener('click', showPrev);
        document.querySelector('.carousel-control-next').addEventListener('click', showNext);
    });
</script>
@endpush
