@extends('layout.adminLayout')
@section('content')
@section('title', 'Admin | Galery')

<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Pengaturan Galeri</h2>
            <div class="table-responsive">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModal('store')">Tambah Konten</button>
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
                                    <button class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanModal('update', {{ $gallery->id }})">Edit</button>
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
                <h5 class="modal-title">Galeri</h5>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post" enctype="multipart/form-data" action="{{ route('galleries.storeOrUpdate') }}">
                    @csrf
                    <input type="hidden" id="formMethod" name="formMethod" value="">
                    <!-- Include hidden field for gallery ID -->
                    <input type="hidden" name="gallery_id" id="editGalleryId" value="">
                    <div class="mb-3">
                        <label for="editJudul">Judul</label>
                        <input type="text" class="form-control" id="editJudul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCaption">Caption</label>
                        <textarea class="form-control" id="editCaption" name="caption" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editGambar">Gambar</label>
                        <input type="file" class="form-control" id="editGambar" name="gambar" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="saveButton">Simpan</button>
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
        function tampilkanModal(action, id = null) {
            $('#tambahKontenModal').modal('show');
            // Clear the form fields when showing the modal for adding or editing gallery
            $('#editForm')[0].reset();
            // Set the form method and action based on the provided action
            if (action === 'store') {
                $('#editForm').attr('method', 'post');
                $('#editForm').attr('action', '{{ route("galleries.storeOrUpdate") }}');
                $('#formMethod').val('store');
            } else if (action === 'update' && id) {
                // Use AJAX to fetch the existing data for the gallery
                $.ajax({
                    url: "{{ url('/galleries/show/') }}" + '/' + id,
                    type: 'GET',
                    success: function (data) {
                        // Fill the form fields with the existing data
                        $('#editGalleryId').val(data.id);
                        $('#editJudul').val(data.judul);
                        $('#editCaption').val(data.caption);
                        // Manually trigger change event for file input to update the displayed file name
                        $('#editGambar').trigger('change');
                        // Update the form method to the update route
                        $('#editForm').attr('action', '{{ route("galleries.storeOrUpdate") }}');
                        // Update the form method to 'update'
                        $('#formMethod').val('update');
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }
        }

        // Add an event listener for the file input to display the selected file name
        $('#editGambar').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        });

        function tutupModal() {
            // Use direct dismissal without relying on a click event
            $('#tambahKontenModal').modal('hide');
        }
    </script>
@endpush
