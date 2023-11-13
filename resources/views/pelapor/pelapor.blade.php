@extends('layout.pelaporLayout')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Data Laporan</h2>
            <div class="table-responsive">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModal()">Input Insiden</button>
                </div>
                <table class="table align-middle text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Insiden Type</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Penanganan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @for ($i = 1; $i < 5; $i++)
                            <tr>
                                <th scope="row">#</th>
                                <td>20/10/2023</td>
                                <td>SQL Injection</td>
                                <td>Eror didapat pada saat bla bla bla</td>
                                <td>Memperkuat SQL Sec</td>
                                <td>
                                    <a class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanModal() ">Edit</a>
                                    <a class="btn btn-sm btn-danger ButtonAksi" href="">Hapus</a>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Konten -->
<div class="modal fade" id="tambahKontenModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Konten</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="isiKonten">Tanggal</label>
                        <textarea class="form-control" id="isiKonten" name="isiKonten" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="isiKonten">Insiden Type</label>
                        <textarea class="form-control" id="isiKonten" name="isiKonten" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="isiKonten">Keterangan</label>
                        <textarea class="form-control" id="isiKonten" name="isiKonten" rows="4"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="tutupModalButton" onclick="tutupModal()">Tutup</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        function tampilkanModal() {
            $('#tambahKontenModal').modal('show');
        }
        function tutupModal() {
            $('#tutupModalButton').click(function () {
                $('#tambahKontenModal').modal('hide');
            });
        }

    </script>
@endpush

@section('title','Pelapor | Report Managemen')