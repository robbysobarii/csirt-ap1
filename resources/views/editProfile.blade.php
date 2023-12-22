@extends('layout.' . auth()->user()->role_user  . 'Layout')
@section('title', 'Edit Profile')
@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="col-8 mx-auto bg-light rounded h-100 p-4">
        <h2 class="mb-4 text-center">Edit Profile</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ auth()->check() ? route('updateProfil', ['id' => auth()->user()->id]) : '#' }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        
            <!-- Display any validation errors here -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        
            <div class="row">
                <!-- Left column for profile picture -->
                <div class="col-md-6 kiriEdit" style="margin: auto;text-align: center">
                    @if(auth()->user()->profile_picture)
                        <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile Picture" style="margin: 20px;max-width: 100%;">
                    @else
                        <p>No profile picture available</p>
                    @endif
                    <div class="mb-3">
                        <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                    </div>
                    
                </div>

                <!-- Right column for other profile details -->
                <div class="col-md-6 kananEdit">
                    <div class="mb-3">
                        <label for="nama_user">Full Name</label>
                        <input type="text" class="form-control" id="nama_user" name="nama_user" value="{{ auth()->user()->nama_user }}" readonly>
                    </div>
                
                    <div class="mb-3">
                        <label for="email_user">Email</label>
                        <input type="email" class="form-control" id="email_user" name="email_user" value="{{ auth()->user()->email_user }}" readonly>
                    </div>
                
                    <div class="mb-3">
                        <label for="old_password">Old Password</label>
                        <input type="password" class="form-control" id="old_password" name="old_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
        
                    <div class="mb-3">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
            </div>
        
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>        
    </div>
</div>

@endsection
