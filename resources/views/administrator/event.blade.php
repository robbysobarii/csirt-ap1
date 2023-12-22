@extends('layout.adminLayout')
@section('content')
@section('title', 'Admin | Event Management')

<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Pengaturan Event</h2>
            <div class="table-responsive">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModal()">Tambah Event</button>
                </div>
                @include('administrator.components._table-event')
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Konten -->
@include('administrator.components._tambahEdit-event')

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
    document.getElementById('editForm').addEventListener('submit', function (event) {
        var name = document.getElementById('name').value;
        var description = document.getElementById('description').value;
        var start_date = document.getElementById('start_date').value;
        var end_date = document.getElementById('end_date').value;
        var location = document.getElementById('location').value;


        if (!name || !description || !start_date || !end_date || !location) {
            alert('Harap isi semua kolom yang wajib diisi.');
            event.preventDefault(); 
        }
    });
    function tutupModal() {
        // Use direct dismissal without relying on a click event
        $('#tambahKontenModal').modal('hide');
    }

    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
        alert(msg);
    }
</script>

@endpush
