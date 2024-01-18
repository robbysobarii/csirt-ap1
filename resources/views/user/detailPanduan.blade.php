<!-- detailPanduanList.blade.php -->
@extends('layout.userLayout')
@section('title', 'Layanan | Panduan Teknis')
@section('content')

<div class="container" >
    <div class="breadcrumb" style="padding-top: 100px; margin-bottom: 0;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Layanan</li>
            <li class="breadcrumb-item">Panduan Teknis</li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">{{ $name }}</a></li>
        </ol>
    </div>
    <h3>Panduan Teknis</h3>
    <hr style="margin-bottom: 30px;">

    <div style="margin-bottom: 20px; text-align: center">
        <h4>{{ $name }}</h4>
    </div>

    <object data="{{ url('file/' . $filename) }}" type="application/pdf" width="100%" height="1000px">
        <embed src="{{ url('file/' . $filename) }}" type="application/pdf" />
    </object>
</div>
@endsection
