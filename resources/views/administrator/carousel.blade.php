@extends('layout.AdminLayout')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Pengaturan Konten</h2>
            <div class="table-responsive">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModal('store')">Tambah Carousel</button>
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
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $carousel->heading_caption }}</td>
                                <td>{{ $carousel->caption }}</td>
                                <td><img src="{{ asset('storage/' .$carousel->image_path) }}" alt="Carousel Image" class="img-fluid"></td>
                                <td>
                                    <button class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanModal('update', {{ $carousel->id }})">Edit</button>
                                    <form action="{{ route('gallery.delete', ['id' => $carousel->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this content?')">
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
                <form id="editForm" method="post" enctype="multipart/form-data" action="{{ route('carousel.storeOrUpdate') }}">
                    @csrf
                    <input type="hidden" id="formMethod" name="formMethod" value="">
                    <!-- Include hidden field for carousel ID -->
                    <input type="hidden" name="carousel_id" id="editCarouselId" value="">
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
        function tampilkanModal(action, id = null) {
            $('#tambahKontenModal').modal('show');
            // Clear the form fields when showing the modal for adding or editing carousel
            $('#editForm')[0].reset();
    
            // Set the form method and action based on the provided action
            if (action === 'store') {
                $('#editForm').attr('method', 'post');
                $('#editForm').attr('action', '{{ route("carousel.storeOrUpdate") }}');
                $('#formMethod').val('store');
            } else if (action === 'update' && id) {
                // Use AJAX to fetch the existing data for the carousel
                $.ajax({
                    url: "{{ url('/carousel/show/') }}" + '/' + id,
                    type: 'GET',
                    success: function (data) {
                        // Fill the form fields with the existing data
                        $('#editCarouselId').val(data.id);
                        $('#heading_caption').val(data.heading_caption);
                        $('#caption').val(data.caption);
    
                        // Manually trigger change event for file input to update the displayed file name
                        $('#image_path').next('.custom-file-label').html(data.image_path);
    
                        // Update the form method to the update route
                        $('#editForm').attr('action', '{{ route("carousel.storeOrUpdate") }}');
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
        $('#image_path').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        });
    
        function tutupModal() {
            // Use direct dismissal without relying on a click event
            $('#tambahKontenModal').modal('hide');
        }
    </script>
    
@endpush

@endsection
@section('title','Admin | Carousel Management')
