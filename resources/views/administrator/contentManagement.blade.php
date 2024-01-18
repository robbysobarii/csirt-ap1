@extends('layout.AdminLayout')
@section('content')
@section('title', 'Admin | Artikel & Berita')

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
                            <th scope="col">Isi Konten</th>
                            <th scope="col" style="min-width: 200px;">Gambar</th>
                            <th scope="col">Type</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="width: 100%">
                        @foreach ($contents as $content)
                            <tr style="max-width: 100%">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td style="word-wrap: break-word;"><b>{{ $content->judul }}</b></td>
                                <td style="word-wrap: break-word; max-width:600px ;">{!! nl2br(e($content->isi_konten)) !!}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $content->gambar) }}" alt="Logo" class="img-fluid">
                                </td>
                                <td>{{ $content->type }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanEditModal({{ $content->id }})">Edit</a>
                                    <form action="{{ route('contents.delete', ['id' => $content->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this content?')">
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
                <h5 class="modal-title">Konten</h5>
            </div>
            <div class="modal-body">
                <!-- Update the form action URL and method -->
                <form id="editForm" method="post" enctype="multipart/form-data" action="{{ route('contents.storeOrUpdate') }}">

                    @csrf
                    <input type="hidden" id="formMethod" name="formMethod" value="">
                    <!-- Include hidden field for content ID -->
                    <input type="hidden" name="content_id" id="editContentId" value="">
                    <div class="mb-3">
                        <label for="editJudul">Judul</label>
                        <input type="text" class="form-control" id="editJudul" name="judul">
                    </div>
                    <div class="mb-3">
                        <label for="editIsiKonten">Isi Konten</label>
                        <textarea class="form-control" id="editIsiKonten" name="isiKonten" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editGambar">Gambar</label>
                        <input type="file" class="form-control" id="editGambar" name="gambar" onchange="updateFileName()">
                        <div id="filename-preview"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="editType">Type</label>
                        <select class="form-select" id="editType" name="type">
                            <option value="Artikel">Artikel</option>
                            <option value="Berita">Berita</option>
                        </select>
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
        function tampilkanModal() {
            $('#tambahKontenModal').modal('show');
            // Clear the form fields when showing the modal for adding or editing content
            $('#editForm')[0].reset();
            // Set the form method to POST
            $('#editForm').attr('method', 'post');
            // Update the form action to the create route
            $('#editForm').attr('action', '{{ route("contents.storeOrUpdate") }}');
            // Update the save button text
            $('#saveButton').text('Simpan');
            $('#formMethod').val('store');
        }

        function tampilkanEditModal(id) {
            // Use the direct route URL in the script
            var routeUrl = "/contents/" + id;

            // Use AJAX to fetch the existing data for the content
            $.ajax({
                url: routeUrl,
                type: 'GET',
                success: function (data) {
                    console.log('Server response:', data);

                    // Fill the form fields with the existing data
                    $('#editContentId').val(data.id);
                    $('#editJudul').val(data.judul);
                    $('#editIsiKonten').val(data.isi_konten);
                    $('#editType').val(data.type);
                    $('#formMethod').val('update');

                    // Update the form action to the update route
                    $('#editForm').attr('action', '{{ route("contents.storeOrUpdate", ['id' => '']) }}' + '/' + id);
                    // Update the save button text
                    $('#saveButton').text('Update');

                    // Show the modal
                    $('#tambahKontenModal').modal('show');

                    // Display the filename preview
                    if (data.gambar) {
                        // Set the filename in the hidden input and preview
                        var buktiFilename = data.gambar;
                        console.log('Image filename:', buktiFilename);
                        $('#editGambar').val(buktiFilename);
                        console.log('Setting filename:', buktiFilename);
                        $('#filename-preview').text(buktiFilename);

                    } else {
                        // Clear the filename in the hidden input and preview
                        $('#editGambar').val(null); // Use null to clear the value
                        $('#filename-preview').text('No Image');
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        function updateFileName() {
            var buktiInput = $('#editGambar');
            var filename = buktiInput.val().replace(/^.*[\\\/]/, '');

            // Declare buktiFilename using var or let
            var buktiFilename = filename;
            $('#editGambar').val(buktiFilename);
            $('#filename-preview').text(buktiFilename);
        }

        function tutupModal() {
            // Use direct dismissal without relying on a click event
            $('#tambahKontenModal').modal('hide');
        }
    </script>
@endpush
