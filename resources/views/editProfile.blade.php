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

        <form action="{{ auth()->check() ? route('updateProfil', ['id' => auth()->user()->id]) : '#' }}" method="post">
            @csrf
            @method('PUT')
        
            <!-- Display any validation errors here -->
        
            <div class="mb-3">
                <label for="nama_user">Full Name</label>
                <input type="text" class="form-control" id="nama_user" name="nama_user" value="{{ auth()->user()->nama_user }}" readonly>
            </div>
        
            <div class="mb-3">
                <label for="email_user">Email</label>
                <input type="email" class="form-control" id="email_user" name="email_user" value="{{ auth()->user()->email_user }}" readonly>
            </div>
        
            <div class="mb-3">
                <label for="password">New Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
        
            <button type="submit" class="btn btn-primary">Update Password</button>
        </form>        
    </div>
</div>

@endsection
