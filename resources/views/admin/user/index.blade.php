@extends('layout.layout')
@section('title', 'Data User')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="m-0">Daftar User Aplikasi</h5>
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-sm">
          <i class="bi bi-plus-lg me-1"></i> Tambah User
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                        @foreach ($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->nama_lengkap }}</td>
                <td><strong>{{ $user->user_name }}</strong></td>
                <td><span class="badge bg-info text-capitalize">{{ $user->role }}</span></td>
                <td>
                    <a href="{{ route('admin.user.edit', $user->id_user) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-fill"></i> Edit
                    </a>
                    <form action="{{ route('admin.user.destroy', $user->id_user) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus user ini?')">
                            <i class="bi bi-trash-fill"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection