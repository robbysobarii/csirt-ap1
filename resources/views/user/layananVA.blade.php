@extends('layout.userLayout')
@section('title', 'Layanan | Layanan VA')
@section('content')
<div class="container text-black" style="background-color: white;">
    <div class="breadcrumb" style="padding-top: 100px; margin-bottom: 0;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Layanan</li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Layanan VA</a></li>
        </ol>
    </div>
    <h3>Layanan VA</h3>
    <hr>
    <div class="layanan" style="color: rgba(0, 0, 0, 0.8);
    ">
        <ol>
            <p><b>Layanan Vulnerability Assesment (VA)</b> dikhusukan bagi konstituen CSIRT Angkasa Pura I yaitu PT Angkasa Pura I dan seluruh kantor cabang dibawahnya. Adapun informasi yang perlu disiapkan untuk pengajuan layanan ini adalah : </p>
            <li>Nama Aplikasi/Website yang akan di VA.</li>
            <li>PIC aplikasi/website (No. HP & Email). </li>
            <li>Target IP/Domain.</li>
            <li>Upload surat permohonan dari satker kepada CSIRT Angkasa Pura I.</li>
        </ol>
    </div>
</div>

@endsection