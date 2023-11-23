@extends('layout.adminLayout')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Data User</h2>
            <div class="table-responsive">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModal()">Tambah User</button>
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
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->role_user }}</td>
                                <td>{{ $user->nama_user }}</td>
                                <td>{{ $user->email_user }}</td>
                                <td>{{ $user->password }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanModal()">Edit</a>
                                    <form method="POST" action="{{ route('user.delete', $user->id) }}" style="display:inline">
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
                <h5 class="modal-title">Tambah Konten</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('user.store') }}">
                    @csrf
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

@section('title','Admin | User Management')
