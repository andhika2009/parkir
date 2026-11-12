@extends('layout.layout')
@section('title', 'Tambah User')

@section('content')
<div class="card shadow-sm col-md-6">
    <div class="card-header bg-white">
        <h5 class="m-0">Tambah User Baru</h5>
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
      <form action="{{ route('admin.user.store') }}" method="POST">
            @csrf

        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control"
                value="{{ old('nama_lengkap') }}" required>
         </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
               <input type="text" name="user_name" class="form-control @error('user_name') is-invalid @enderror"
       value="{{ old('user_name') }}" required>
@error('user_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                    <option value="owner">Owner</option>
                </select>
                @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection