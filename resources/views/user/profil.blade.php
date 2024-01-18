@extends('layout.userLayout')
@section('title', 'Tentang Kami | Profil')
@section('content')
<div class="container text-black" style="background-color: white;">
    <div class="breadcrumb" style="padding-top: 100px; margin-bottom: 0;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Tentang Kami</li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Profil</a></li>
        </ol>
    </div>
    <h3>Profil</h3>
    <hr>
    <div class="profil">
        <img src="/img/profil.svg" alt="Profil" style="margin-top:30px ">
        <div class="konten">
            <div class="profilKiri">
                <p><b>Tim Tanggap Insiden Siber/Computer Security Inicident Response Team Angkasa Pura I (AP1-CSIRT)</b> ditetapkan oleh Ketua AP1-CSIRT Tim Tanggap Insiden Siber di Lingkungan Angkasa Pura I. Dalam Angkasa Pura I, Direktur Komersial dan Pelayanan ditunjuk sebagai Ketua AP1-CSIRT dan ditugaskan untuk melaksanakan perumusan, perencanaan, pembangunan, pengoperasian, pengembangan, pengawasan, evaluasi dan anggaran terkait AP1-CSIRT.</p>
            </div>
            <div class="profilKanan">
                <h3 style="color: #015EC5;">Layanan Tanggap Insiden Siber <span style="color: #4F9E19">AP1-CSIRT</span></h3>
                <div style="margin-inline:auto;background-color: rgba(245, 245, 245, 0.4);width: 100%;">
                    <h5 style="color: #4F9E19; margin-top: 30px;">Layanan Reaktif</h5>
                    <p >Pemberian peringatan (alerts and warning), penanggulangan dan pemulihan insiden siber (incident handling), penanganan kerawanan (vulnerability handling) dan penanganan bukti insiden (artifact handling).</p>
                </div>          
                <div style="margin-inline:auto;background-color: rgba(245, 245, 245, 0.4);width: 100%;margin-top: 20px ">
                    <h5 style="color: #4F9E19; margin-top: 30px;">Layanan Proaktif</h5>
                    <p>Review keamanan siber (cyber security review).</p>
                </div>        
                <div style="margin-inline:auto;background-color: rgba(245, 245, 245, 0.4);width: 100%;margin-top: 20px ">
                    <h5 style="color: #4F9E19; margin-top: 30px;">Layanan Manajemen Kualitas Keamanan</h5>
                    <p>Analisis risiko (risk analysis) dan edukasi/pelatihan (education/ training).</p>
                </div>  
            </div>
        </div>
    </div>
</div>

@endsection