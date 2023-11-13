@extends('layout.superLayout')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
        <!-- Box 1: Halaman Admin -->
        <div class="col-3 text-center rounded bg-light p-4 mb-4">
            <a href="{{ route('admin.contentManagement') }}" class="box">
                <i class="fa fa-user fa-3x text-primary mb-2"></i>
                <p class="mb-2">Halaman Admin</p>
            </a>
        </div>

        <!-- Box 2: Halaman Pelapor -->
        <div class="col-3 text-center rounded bg-light p-4 mb-4 mx-5">
            <a href="{{ route('pelapor.reportPelapor') }}" class="box">
                <i class="fa fa-user fa-3x text-primary mb-2"></i>
                <p class="mb-2">Halaman Pelapor</p>
            </a>
        </div>


        <!-- Box 3: Halaman Pimpinan -->
        <div class="col-3 text-center rounded bg-light p-4 mb-4 ">
            <a href="{{ route('pimpinan.dashboard') }}" class="box">
                <i class="fa fa-user fa-3x text-primary mb-2"></i>
                <p class="mb-2">Halaman Pimpinan</p>
            </a>
        </div>
    </div>
</div>
@endsection
@section('title', 'Superuser')
