@extends('layout.userLayout')
@section('title', 'Tentang Kami | Struktur')
@section('content')

<div class="container text-black" style="background-color: white;">
    <div class="breadcrumb breadTop">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item">Tentang Kami</li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Struktur Organisasi</a></li>
        </ol>
    </div>
    <h3>Struktur Organisasi</h3>
    <hr>
    <div>
        <img src="/img/strukturOrganisasi.png" class="img-fluid" alt="Profil" style="margin-top:30px ">
    </div>
</div>

@endsection