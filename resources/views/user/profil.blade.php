@extends('layout.userLayout')
@section('title', 'Tentang Kami | Profil')
@section('content')
<div class="container text-black" style="background-color: white;">
    <div class="breadcrumb breadTop">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Tentang Kami</li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Profil</a></li>
        </ol>
    </div>
    <h3>Profil</h3>
    <hr>
    <div>
        <img src="/img/profil.svg" alt="Profil" class="img-fluid" style="margin-top:30px ">
    </div>
</div>

@endsection