@extends('layout.userLayout')
@section('title', 'Berita')
@section('content')

<div class="container">
    <div class="breadcrumb d-flex justify-content-between" style="padding-top: 100px; margin-bottom: 0;">
        <div>Berita | <a href="{{ route('user.beranda') }}">Kembali</a></div>
        <div><a href="{{ route('daftarBerita') }}" style="color: #66B82E;">Daftar Berita</a></div>
    </div>
    <h3 style="margin-top: 50px;">{{ $content->judul }}</h3>
    <hr>
    <div class="kontenBerita" style="display: flex;flex-direction: column; text-align: justify; word-wrap: break-word;">
        <img src="{{ asset('storage/' . $content->gambar) }}" alt="content" style="width: 50%; margin-block: 30px; margin-inline: auto;">
        <p style="text-align: justify; padding: 5px">{!! nl2br(e($content->isi_konten)) !!}</p>
        <div class="breadcrumb d-flex justify-content-between" style="padding-top: 20px; margin-bottom: 0;">
            @if($prevContent)
                <div><a href="{{ route('berita', $prevContent->id) }}">Sebelumnya</a></div>
            @else
                <div></div>
            @endif
            @if($nextContent)
                <div><a href="{{ route('berita', $nextContent->id) }}">Selanjutnya</a></div>
            @else
                <div></div>
            @endif
        </div>
    </div>
</div>

@endsection
