@extends('layout.pimpinanLayout')
@section('content')
<style>
    /* Custom CSS to set the height of td elements */
    table td {
        height: 60px; /* You can adjust the height value as needed */
    }
</style>
<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Data Laporan</h2>
            <div class="table-responsive">
                <table class="table align-middle text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">SATKER</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Insiden Type</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Penanganan</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @for ($i = 1; $i < 5; $i++)
                            <tr>
                                <th scope="row">#</th>
                                <td>Superuser</td>
                                <td>20/10/2023</td>
                                <td>SQL Injection</td>
                                <td>Eror didapat pada saat bla bla bla</td>
                                <td>Memperkuat SQL Sec</td>
                                <td>Ditangani</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
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
