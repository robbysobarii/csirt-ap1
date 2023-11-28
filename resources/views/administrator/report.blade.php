@extends('layout.adminLayout')
@section('content')
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
                            <th scope="col">Nama User</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Insiden Type</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Penanganan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Bukti</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                        <tr>
                            <th scope="row">{{ $report->id }}</th>
                            <td>{{ $report->satker }}</td>
                            <td>{{ $report->user->nama_user }}</td>
                            <td>{{ $report->tanggal }}</td>
                            <td>{{ $report->insiden_type }}</td>
                            <td>{{ $report->keterangan }}</td>
                            <td>{{ $report->penanganan }}</td>
                            <td>{{ $report->status }}</td>
                            <td>
                                @if($report->bukti)
                                    <img src="{{ Storage::url('images/' . $report->bukti) }}" alt="Bukti" style="max-width: 100px; max-height: 100px;">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanModal('{{ $report->id }}')">Update</button>
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
                <h5 class="modal-title">Update Konten</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('report.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="text" name="user_id" id="user_id" value="{{ $auth->id }}" hidden>
                    <input type="hidden" name="report_id" id="report_id" value="">
                    
                    <div class="mb-3">
                        <label for="satker">SATKER</label>
                        <input class="form-control" type="text" name="satker" id="satker" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama_user">Nama User</label>
                        <input class="form-control" type="text" name="nama_user" id="nama_user" readonly >
                    </div>
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
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Pending">Pending</option>
                            <option value="Ditangani">Ditangani</option>
                            <option value="Close">Close</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bukti">Bukti</label>
                        <input type="file" class="form-control" id="bukti" name="bukti" onchange="updateFileName()">
                        <div id="filename-preview"></div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="tutupModal()">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Variable untuk menyimpan nama file
    var buktiFilename = '';

    function tampilkanModal(reportId) {
        var report = {!! json_encode($reports) !!}.find(report => report.id == reportId);

        $('#tambahKontenModal').modal('show');
        $('#report_id').val(report.id);
        $('#satker').val(report.satker);
        $('#nama_user').val(report.nama_user);
        $('#tanggal').val(report.tanggal);
        $('#insiden_type').val(report.insiden_type);
        $('#keterangan').val(report.keterangan);
        $('#penanganan').val(report.penanganan);
        $('#status').val(report.status);

        // Check if the report has a bukti (image)
        if (report.bukti) {
            // Set the filename in the hidden input and preview
            buktiFilename = report.bukti;
            $('#bukti-filename').val(buktiFilename);
            $('#filename-preview').text(buktiFilename);
        } else {
            // Clear the filename in the hidden input and preview
            buktiFilename = '';
            $('#bukti-filename').val(buktiFilename);
            $('#filename-preview').text('No Image');
        }
    }

    function updateFileName() {
        var buktiInput = $('#bukti');
        var filename = buktiInput.val().replace(/^.*[\\\/]/, '');

        // Menetapkan nama file ke dalam hidden input dan preview
        buktiFilename = filename;
        $('#bukti-filename').val(buktiFilename);
        $('#filename-preview').text(buktiFilename);
    }

    function tutupModal() {
        // Membersihkan variabel nama file ketika menutup modal
        buktiFilename = '';
        $('#tambahKontenModal').modal('hide');
    }
</script>
@endpush
@endsection
@section('title','Admin | Report Managemen')
