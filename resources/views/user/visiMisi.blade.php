@extends('layout.userLayout')
@section('title', 'Tentang Kami | Visi Misi')
@section('content')

<div class="container text-black" style="background-color: white;">
    <div class="breadcrumb" style="padding-top: 130px; margin-bottom: 0;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Tentang Kami</li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Visi Misi</a></li>
        </ol>
    </div>
    <h3>Visi Misi</h3>
    <hr>
    <div class="visiMisi">
        <img src="/img/visiMisi.svg" alt="visiMisi" style="margin-top:30px ">
    </div>
</div>
@endsection