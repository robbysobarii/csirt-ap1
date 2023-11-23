@extends('layout.userLayout')
@section('title', 'Tentang Kami | Struktur')
@section('content')

<div class="container text-black" style="background-color: white;">
    <div class="breadcrumb" style="padding-top: 100px; margin-bottom: 0;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Tentang Kami</li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Struktur Organisasi</a></li>
        </ol>
    </div>
    <h3>Struktur Organisasi</h3>
    <hr>
    <div class="profil">
        <img src="/img/struktur.svg" alt="Profil" style="margin-top:30px ">
    </div>
</div>

@endsection