@extends('layout.adminLayout')
@section('content')
@section('title', 'Admin | Galery')

<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Pengaturan Konten</h2>
            <div class="table-responsive">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModal()">Tambah Konten</button>
                </div>
                <table class="table align-middle text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Caption</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($galleries as $gallery)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $gallery->judul }}</td>
                                <td>{{ $gallery->caption }}</td>
                                <td><img src="{{ asset('storage/' . $gallery->gambar) }}" alt="Gambar" class="img-fluid"></td>
                                <td>
                                    <a class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanModal()">Edit</a>
                                    <form action="{{ route('gallery.delete', ['id' => $gallery->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this content?')">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger ButtonAksi">Hapus</button>
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
                <form action="{{ route('galleries.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="caption">Caption</label>
                        <textarea class="form-control" id="caption" name="caption" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="tutupModalButton" onclick="tutupModal()">Tutup</button>
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

