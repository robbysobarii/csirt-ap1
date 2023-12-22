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
                <h5 class="modal-title">Tambah User</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.storeOrUpdate') }}" method="post" enctype="multipart/form-data" id="editForm">
                    @csrf
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
                        <label for="password">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" oninput="checkPasswordStrength()">
                        <div id="passwordStrength" class="text-muted"></div>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" oninput="checkPasswordMismatch()">
                        <div id="passwordMismatch" class="text-danger"></div>
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

        if (action === 'store') {
            $('#role_user').val('Pelapor');
            $('#nama_user').val('');
            $('#email_user').val('');
            $('#password').val('');
            $('#passwordStrength').text('');
            $('#passwordMismatch').text('');

            $('#editForm').attr('method', 'post');
            $('#editForm').attr('action', '{{ route("users.storeOrUpdate") }}');
            $('#formMethod').val('store');
        } else if (action === 'update' && id) {
            $.ajax({
                url: "{{ url('/users/show/') }}" + '/' + id,
                type: 'GET',
                success: function (data) {
                    if (data.error) {
                        console.error(data.error);
                    } else {
                        $('#role_user').val(data.role_user);
                        $('#nama_user').val(data.nama_user);
                        $('#email_user').val(data.email_user);
                        
                        $('#user_id').val(id);

                        $('#editForm').attr('method', 'post');
                        $('#editForm').attr('action', '{{ route("users.storeOrUpdate") }}');
                        $('#formMethod').val('update');
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
    }

    function checkPasswordStrength() {
        var password = $('#password').val();
        var strength = 0;

        // Check the password strength and update the indicator
        if (password.match(/[a-z]+/)) {
            strength += 1;
        }
        if (password.match(/[A-Z]+/)) {
            strength += 1;
        }
        if (password.match(/[0-9]+/)) {
            strength += 1;
        }
        if (password.match(/[$@#&!]+/)) {
            strength += 1;
        }

        if (password.length < 8) {
            strength = 0;
        }

        switch (strength) {
            case 0:
                $('#passwordStrength').text('');
                break;
            case 1:
                $('#passwordStrength').text('Weak');
                break;
            case 2:
                $('#passwordStrength').text('Moderate');
                break;
            case 3:
            case 4:
                $('#passwordStrength').text('Strong');
                break;
        }
    }

    function checkPasswordMismatch() {
        var password = $('#password').val();
        var confirm_password = $('#confirm_password').val();

        if (password !== confirm_password) {
            $('#passwordMismatch').text('Password tidak sesuai.');
        } else {
            $('#passwordMismatch').text('');
        }
    }

    // $('#editForm').submit(function (event) {
    //     var password = $('#password').val();
    //     var confirm_password = $('#confirm_password').val();

    //     if (password !== confirm_password) {
    //         $('#passwordMismatch').text('Password tidak sesuai.');
    //         event.preventDefault();
    //     } else {
    //         $('#passwordMismatch').text('');
    //     }
    // });
</script>
@endpush

@section('title', 'Superuser')
