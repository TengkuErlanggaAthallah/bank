@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Edit Profile</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password (leave blank to keep current password)</label>
            <div class="input-group">
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
                <button type="button" class="btn btn-outline-secondary" id="togglePassword" onclick="togglePasswordVisibility()">
                    <span id="toggleIcon" class="bi bi-eye-fill"></span>
                </button>
            </div>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="profile_picture">Profile Picture</label>
            <input type="file" id="profile_picture" name="profile_picture" class="form-control">
            @if($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="mt-2" style="width: 100px; height: auto;">
            @endif
        </div>

        <button type="submit" class=" btn btn-primary">Update Profile</button>
    </form>
</div>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.remove("bi-eye-fill");
            toggleIcon.classList.add("bi-eye-slash-fill");
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.remove("bi-eye-slash-fill");
            toggleIcon.classList.add("bi-eye-fill");
        }
    }
</script>
@endsection