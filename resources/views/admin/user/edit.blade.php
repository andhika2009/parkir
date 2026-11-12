@extends('layout.layout')
@section('title', 'Edit User')

@section('content')
<div class="card shadow-sm col-md-6">
    <div class="card-header bg-white">
        <h5 class="m-0">Edit User</h5>
    </div>
    <div class="card-body">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.user.update', $user->id_user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror"
                       value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required>
                @error('nama_lengkap') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="user_name" autocomplete="off" class="form-control @error('user_name') is-invalid @enderror"
                       value="{{ old('user_name', $user->user_name) }}" required>
                @error('user_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Password <small class="text-muted">(Kosongkan jika tidak ingin diubah)</small></label>
                <input type="password" name="password" autocomplete="new-password" class="form-control @error('password') is-invalid @enderror">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                    <option value="admin"   {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>Petugas</option>
                    <option value="owner"   {{ old('role', $user->role) == 'owner' ? 'selected' : '' }}>Owner</option>
                </select>
                @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Batal</a>
        </form>

    </div>
</div>
@endsection