@extends('layout.userLayout')
@section('title','Beranda')
@section('content')

<div id="carouselExample" class="carousel slide position-relative">
    <div class="carousel-inner" style="max-height: 600px">
        @include('user.components._carousel-item')
        <!-- Container for ARTIKEL DAN BERITA -->
        <div class="containerAJudul w-100 position-absolute px-5">
            <h4 >| ARTIKEL DAN BERITA</h4>
            
        </div>
    </div>

    @include('user.components._carousel-move')
</div>


<div class="container">
    <div class="head containerContent">
        <div class="judul">
            <h2>INFO SIBER</h2>
            @if($latestContent)
                <p>Terakhir update: {{ $latestContent->updated_at->format('d/m/Y') }}</p>
            @else
                <p>Terakhir update: Tidak ada informasi</p>
            @endif
        </div>
    </div>
    
    
    <hr>
    <div class="main">
        @if($content->count() > 3)
            <div class="kiri">
                @include('user.components._konten-berita-kiri')
            </div>
            

            <div class="kanan">
                @include('user.components._konten-berita-kanan')
            
                @if($content->count() > 5)
                    <div class="lihatSemua">
                        <a href="{{ route('daftarBerita') }}" >Lihat Semua</a>
                    </div>
                @endif
            </div>
        @else
            @if($content->count() > 0)
                @foreach($content->take(1) as $item)
                    <div>
                        <div style="text-align: center">
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="content" style="width: 100%; margin-top: 40px;margin-bottom: 10px">
                        </div>
                        <p style="color: #66B82E;font-style: italic;font-size: 13px;padding:0;margin:0;">{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</p>
                        <h3 style="margin-top: 15px">$item->judul</h3>
                        <p style="text-align: justify;">{{ \Illuminate\Support\Str::limit($item->isi_konten, 550) }}</p>
                        <a href="{{ route('berita', ['id' => $item->id]) }}" class="selengkap"><b>> Selengkapnya</b></a>
                    </div>
                @endforeach
            
            @else
                <p>No content available</p>
            @endif
        @endif
    </div>
            
    @if($content->count() < 3 && $content->count() >= 1)
        <div class="lihatSemuaSatu">
            <a href="{{ route('daftarBerita') }}" >Lihat Semua</a>
        </div>
    @endif
    
</div>

<div class="galery-head container-fluid position-relative">
    <img src="/img/galeryHead.svg" class="w-100" alt="Heading">
</div>

<div class="container">
    <div id="galleryCarousel" class="carousel d-flex align-items-center justify-content-center"> 
        <div class="carousel-inner-galery container-fluid">
            @include('user.components._galery-item')
        </div>
        @include('user.components._galery-move')
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    let galleryIndex = 0;
    const galleryItems = document.querySelectorAll('.carousel-item-galery');
    const totalGalleryItems = galleryItems.length;

    function updateGallery() {
        galleryItems.forEach((item, index) => {
            const newIndex = (index - galleryIndex + totalGalleryItems) % totalGalleryItems;
            item.style.order = newIndex + 1;
        });
    }

    function showNextGallery() {
        galleryIndex = (galleryIndex + 1) % totalGalleryItems;
        updateGallery();
    }

    function showPrevGallery() {
        galleryIndex = (galleryIndex - 1 + totalGalleryItems) % totalGalleryItems;
        updateGallery();
    }

    document.querySelector('.carousel-control-prev-galery').addEventListener('click', showPrevGallery);
    document.querySelector('.carousel-control-next-galery').addEventListener('click', showNextGallery);

    updateGallery();
});



</script>
@endpush
