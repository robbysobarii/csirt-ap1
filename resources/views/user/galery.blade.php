@extends('layout.userLayout')
@section('title', 'Galeri')
@section('content')

<div class="container">
    <div class="breadcrumb d-flex justify-content-between" style="padding-top: 100px; margin-bottom: 0;">
        <div>Galeri | <a href="{{ route('user.beranda') }}">Kembali</a></div>
    </div>

    <div class="row mt-3" style="padding-top: 40px">
        <div class="col-md-6">
            <div class="kiriGalery">
                <img src="{{ asset('storage/' . $galleries->gambar) }}" alt="Galery" style="width: 100%;">
            </div>
        </div>
        <div class="col-md-6">
            <div class="kananGalery p-5">
                @if ($prevContent)
                    <a href="{{ route('galeri', $prevContent->id) }}">Sebelumnya</a>
                @endif
                <h3 style="margin-top: 30px">{{ $galleries->judul }}</h3>
                <hr style="margin-top: 15px; margin-bottom: 15px;">
                <p>{{$galleries->caption}}</p>
                @if ($nextContent)
                    <a href="{{ route('galeri', $nextContent->id) }}" class="float-end" style="margin-top: 30px;">Selanjutnya</a>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
