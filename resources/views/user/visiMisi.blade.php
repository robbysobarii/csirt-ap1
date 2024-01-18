@extends('layout.userLayout')
@section('title', 'Tentang Kami | Visi Misi')
@section('content')

<div class="container text-black" style="background-color: white;">
    <div class="breadcrumb" style="padding-top: 100px; margin-bottom: 0;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Tentang Kami</li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Visi Misi</a></li>
        </ol>
    </div>
    <h3>Visi Misi</h3>
    <hr>
    <div class="visiMisi">
        <img src="/img/visiMisi.svg" alt="visiMisi" style="margin-top:30px ">
        <div class="konten">
            <div style="margin-top: 50px">
                <ul class="green-box-list" style="list-style: none; ">
                    <h4 style="color: #0072B9;">Misi</h4>
                    <li>Mendorong kegiatan pengamanan informasi dan pencegahan insiden keamanan informasi.</li>
                    <li>Membangun kesadaran keamanan informasi pada sumber daya manusia di lingkungan PT. Angkasa Pura I.</li>
                    <li>Menjamin keamanan informasi pada aset informasi PT. Angkasa Pura I.</li>
                </ul>
            </div>
            <div style="margin-top: 80px">
                <ul class="green-box-list" style="list-style: none; ">
                    <li>Melaksanakan evaluasi secara berkala keandalan sistem keamanan teknologi informasi di lingkungan PT. Angkasa Pura I.</li>
                    <li>Meningkatkan kompetensi dan kapasitas sumber daya penanggulangan dan pemulihan keamanan siber di lingkungan PT. Angkasa Pura I.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection