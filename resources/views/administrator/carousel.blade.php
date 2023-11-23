@extends('layout.adminLayout')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Pengaturan Konten</h2>
            <div class="table-responsive">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModal()">Tambah Carousel</button>
                </div>
                <table class="table align-middle text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Heading Caption</th>
                            <th scope="col">Caption</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carousels as $carousel)
                            <tr>
                                <th scope="row">{{ $carousel->id }}</th>
                                <td>{{ $carousel->heading_caption }}</td>
                                <td>{{ $carousel->caption }}</td>
                                <td><img src="{{ asset('storage/' .$carousel->image_path) }}" alt="Carousel Image" class="img-fluid"></td>
                                <td>
                                    <a class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanModal()">Edit</a>
                                    <form action="{{ route('carousel.delete', ['id' => $carousel->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this carousel?')">
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
                <form action="{{ route('carousel.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="heading_caption">Heading Caption</label>
                        <input type="text" class="form-control" id="heading_caption" name="heading_caption">
                    </div>
                    <div class="mb-3">
                        <label for="caption">Caption</label>
                        <input type="text" class="form-control" id="caption" name="caption">
                    </div>
                    <div class="mb-3">
                        <label for="image_path">Gambar</label>
                        <input type="file" class="form-control" id="image_path" name="image_path">
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

@endsection
@section('title','Admin | Carousel Management')
