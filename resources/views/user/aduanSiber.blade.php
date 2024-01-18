@extends('layout.userLayout')
@section('title', 'Layanan | Aduan Siber')
@section('content')

<div class="container text-black" style="background-color: white;">
    <div class="breadcrumb" style="padding-top: 100px; margin-bottom: 0;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Layanan</li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Aduan Siber</a></li>
        </ol>
    </div>
    <h3>Aduan Siber</h3>
    <hr>
    <div class="layanan">
        
        <h4 style="margin:0; padding: 0">Prosedur Aduan Siber</h4>
        <ol style="padding-left: 20px; margin-top: 10px">
            <li>Penerimaan aduan insiden siber melalui telepon (021) 6541961 ext.2161 atau surel csirt@ap1.co.id. </li>
            <li>Pencatatan aduan insiden siber baik identitas pelapor disertai data dukung dan bukti terjadinya insiden siber.</li>
            <li>Notifikasi penerimaan aduan insiden siber. </li>
            <li>Verifikasi aduan insiden siber.</li>
            <li>Observasi dan investigasi aduan insiden siber.</li>
            <li>Pemberian rekomendasi cara penanggulanangan insiden siber.</li>
            <li>Jika administrator IT/pemilik aset tidak dapat menyelesaikan insiden siber dapat meminta BSSN untuk dapat membantu menindaklanjuti aduan insiden siber</li>
        </ol>
        <hr>
        <div style="display: flex; justify-content: center;align-content: center; margin-top: 30px">
            <img src="/img/aduan.svg" alt="aduan" >
        </div>
    </div>
</div>

@endsection