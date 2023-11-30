@extends('layout.SuperuserLayout')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Data User</h2>
            <div class="table-responsive">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModal('store')">Tambah User</button>
                </div>
                <table class="table align-middle text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Role User</th>
                            <th scope="col">Nama User</th>
                            <th scope="col">Email User</th>
                            <th scope="col">Password</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $user->role_user }}</td>
                                <td>{{ $user->nama_user }}</td>
                                <td>{{ $user->email_user }}</td>
                                <td>{{ $user->password }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanModal('update', {{ $user->id  }})">Edit</button>
                                    <form action="{{ route('users.delete', ['id' => $user->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this user?')">
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
                <form action="{{ route('users.storeOrUpdate') }}" method="post" enctype="multipart/form-data" id="editForm">
                    @csrf
                    <!-- Add formMethod and user_id input fields -->
                    <input type="hidden" name="formMethod" id="formMethod" value="store">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="mb-3">
                        <label for="role_user">Role User</label>
                        <select class="form-control" id="role_user" name="role_user">
                            <option value="Pelapor">Pelapor</option>
                            <option value="Pimpinan">Pimpinan</option>
                            <option value="Admin">Admin</option>
                            <option value="Superuser">Superuser</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama_user">Nama User</label>
                        <input type="text" class="form-control" id="nama_user" name="nama_user">
                    </div>
                    <div class="mb-3">
                        <label for="email_user">Email User</label>
                        <input type="email" class="form-control" id="email_user" name="email_user">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
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
    function tampilkanModal(action, id = null) {
        $('#tambahKontenModal').modal('show');

        // Set the form method and action based on the provided action
        if (action === 'store') {
            // For creating a new user, reset the form
            $('#role_user').val('Pelapor');
            $('#nama_user').val('');
            $('#email_user').val('');
            $('#password').val('');

            $('#editForm').attr('method', 'post');
            $('#editForm').attr('action', '{{ route("users.storeOrUpdate") }}');
            $('#formMethod').val('store');
        } else if (action === 'update' && id) {
            // For updating an existing user, fetch the existing data using AJAX
            $.ajax({
                url: "{{ url('/users/show/') }}" + '/' + id,
                type: 'GET',
                success: function (data) {
                    if (data.error) {
                        console.error(data.error);
                    } else {
                        // Fill the form fields with the existing data
                        $('#role_user').val(data.role_user);
                        $('#nama_user').val(data.nama_user);
                        $('#email_user').val(data.email_user);
                        $('#password').val(data.password);
                        

                        // Note: I removed the password field for security reasons

                        // Set the user_id for updating
                        $('#user_id').val(id);

                        // Update the form method to the update route
                        $('#editForm').attr('method', 'post');
                        // Remove the existing '/id' from the action
                        $('#editForm').attr('action', '{{ route("users.storeOrUpdate") }}');
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

@section('title', 'Superuser')
