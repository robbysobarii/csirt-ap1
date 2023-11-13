@extends('layout.adminLayout')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Pengaturan Konten</h2>
            <div class="table-responsive">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-info ms-2 addButton">Lihat Preview</button>
                </div>
                <table class="table align-middle text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Fitur</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @for ($i = 1; $i < 5; $i++)
                            <tr>
                                <th scope="row">#</th>
                                <td>Beranda</td>
                                <td>Aktif</td>
                                <td>
                                    <a class="btn btn-sm btn-danger ButtonAksi" onclick="tampilkanModal()">Non-Aktifkan</a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">#</th>
                                <td>Beranda</td>
                                <td>Tidak Aktif</td>
                                <td>
                                    <a class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanModal()">Aktifkan</a>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('title','Admin | Carousel Managemen')