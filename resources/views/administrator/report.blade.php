@extends('layout.adminLayout')
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
                            <th scope="col">SATKER</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Insiden Type</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Penanganan</th>
                            <th scope="col">Nama User</th>
                            <th scope="col">Bukti</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                            <tr>
                                <th scope="row">{{ $report->id }}</th>
                                <td>{{ $report->satker }}</td>
                                <td>{{ $report->tanggal }}</td>
                                <td>{{ $report->insiden_type }}</td>
                                <td>{{ $report->keterangan }}</td>
                                <td>{{ $report->penanganan }}</td>
                                <td>{{ $report->user->nama_user }}</td>
                                <td>
                                    @if($report->bukti)
                                        <img src="{{ asset('images/' . $report->bukti) }}" alt="Bukti" style="max-width: 100px; max-height: 100px;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanModal()">Update</a>
                                    <form method="POST" action="{{ route('report.delete', $report->id) }}" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger ButtonAksi" onclick="return confirm('Are you sure?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
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
                <form method="POST" action="{{ route('report.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="insiden_type">Insiden Type</label>
                        <select class="form-control" id="insiden_type" name="insiden_type" required>
                            <option value="Malware">Malware</option>
                            <option value="DDoS">Serangan DDoS</option>
                            <option value="Phishing">Serangan Phishing</option>
                            <option value="SQL Injection">Serangan SQL Injection</option>
                            <option value="Web Defacement">Web Defacement</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="penanganan">Penanganan</label>
                        <textarea class="form-control" id="penanganan" name="penanganan" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="bukti">Bukti</label>
                        <input type="file" class="form-control" id="bukti" name="bukti">
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="tutupModalButton" onclick="tutupModal()">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
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
@section('title','Admin | Report Managemen')
