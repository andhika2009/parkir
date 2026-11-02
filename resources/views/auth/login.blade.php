<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Parkir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">

    <div class="card p-4 shadow-sm" style="max-width: 400px; width: 100%; border-radius: 12px;">
        <div class="text-center mb-4">
            <h4 class="fw-bold">Login</h4>
            <p class="text-muted small">Masuk ke akun Anda untuk mengakses sistem parkir.</p>
        </div>

        {{-- PAPARKAN MESEJ RALAT JIKA LOGIN GAGAL --}}
        @if($errors->any())
            <div class="alert alert-danger p-2 small text-center mb-3">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label small">Username</label>
                <input type="text" name="username" id="username" class="form-value form-control" placeholder="Masukkan username" value="{{ old('username') }}" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label small">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-2 py-2">Login</button>
        </form>
    </div>

</body>
</html>