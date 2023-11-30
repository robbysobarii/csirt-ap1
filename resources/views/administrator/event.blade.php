@extends('layout.adminLayout')
@section('content')
@section('title', 'Admin | Event Management')

<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Pengaturan Event</h2>
            <div class="table-responsive">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModal()">Tambah Konten</button>
                </div>
                <table class="table align-middle text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Acara</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Tanggal Awal</th>
                            <th scope="col">Tanggal Akhir</th>
                            <th scope="col">Tempat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->description }}</td>
                                <td>{{ $event->start_date }}</td>
                                <td>{{ $event->end_date }}</td>
                                <td>{{ $event->location }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanModal('update', {{ $event->id  }})">Edit</button>
                                    <form action="{{ route('events.delete', ['id' => $event->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this event?')">
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
                <h5 class="modal-title">Event</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('events.storeOrUpdate') }}" method="post" enctype="multipart/form-data" id="editForm">
                    @csrf
                    <input type="hidden" name="formMethod" id="formMethod" value="store"> <!-- Add this line -->
                    <input type="hidden" name="event_id" id="event_id">
                    <div class="mb-3">
                        <label for="name">Acara</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="description">Deskripsi</label>
                        <input type="text" class="form-control" id="description" name="description">
                    </div>
                    <div class="mb-3">
                        <label for="start_date">Tanggal Awal</label>
                        <input type="date" class="form-control" id="start_date" name="start_date">
                    </div>
                    <div class="mb-3">
                        <label for="end_date">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="end_date" name="end_date">
                    </div>
                    <div class="mb-3">
                        <label for="location">Tempat</label>
                        <textarea class="form-control" id="location" name="location" rows="4"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="tutupModalButton" onclick="tutupModal()">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function tampilkanModal(action, id = null) {
    $('#tambahKontenModal').modal('show');

    // Set the form method and action based on the provided action
    if (action === 'store') {
        // For creating a new event, reset the form
        $('#name').val('');
        $('#description').val('');
        $('#start_date').val('');
        $('#end_date').val('');
        $('#location').val('');

        $('#editForm').attr('method', 'post');
        $('#editForm').attr('action', '{{ route("events.storeOrUpdate") }}');
        $('#formMethod').val('store');
    } else if (action === 'update' && id) {
        // For updating an existing event, fetch the existing data using AJAX
        $.ajax({
            url: "{{ url('/events/show/') }}" + '/' + id,
            type: 'GET',
            success: function (data) {
                if (data.error) {
                    console.error(data.error);
                } else {
                    // Fill the form fields with the existing data
                    $('#name').val(data.name);
                    $('#description').val(data.description);
                    $('#start_date').val(data.start_date);
                    $('#end_date').val(data.end_date);
                    $('#location').val(data.location);
                    // Set the event_id for updating
                    $('#event_id').val(id);

                    // Update the form method to the update route
                    $('#editForm').attr('method', 'post');
                    // Remove the existing '/id' from the action
                    $('#editForm').attr('action', '{{ route("events.storeOrUpdate") }}');
                    // Update the form method to 'update'
                    $('#formMethod').val('update');
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    }
}

    function tutupModal() {
        // Use direct dismissal without relying on a click event
        $('#tambahKontenModal').modal('hide');
    }
</script>

@endpush
