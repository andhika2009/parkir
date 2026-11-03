<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Parkir</title>
    <!-- Google Font Modern -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #0b0f19;
            overflow: hidden;
            position: relative;
        }

        /* Ambient Animated Orbs */
        .ambient-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.35;
            pointer-events: none;
            animation: moveOrb 12s ease-in-out infinite alternate;
        }

        .orb-1 {
            width: 350px;
            height: 350px;
            background: #3b82f6;
            top: 15%;
            left: 20%;
        }

        .orb-2 {
            width: 300px;
            height: 300px;
            background: #6366f1;
            bottom: 15%;
            right: 20%;
            animation-delay: -6s;
        }

        @keyframes moveOrb {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(40px, -30px) scale(1.1); }
            100% { transform: translate(-30px, 40px) scale(0.95); }
        }

        /* Card Login */
        .login-card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 400px;
            padding: 2.5rem;
            background: rgba(17, 24, 39, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .brand-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-header h2 {
            color: #ffffff;
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 0.4rem;
        }

        .brand-header p {
            color: #9ca3af;
            font-size: 0.875rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            color: #d1d5db;
            font-size: 0.825rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.8rem 1rem;
            background: rgba(31, 41, 55, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            color: #ffffff;
            font-size: 0.9rem;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-input:focus {
            background: rgba(31, 41, 55, 0.9);
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
        }

        .form-input::placeholder {
            color: #6b7280;
        }

        .btn-submit {
            width: 100%;
            padding: 0.85rem;
            background: #2563eb;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 0.5rem;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }

        .btn-submit:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.35);
        }

        .btn-submit:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>

    <!-- Animasi Latar Belakang -->
    <div class="ambient-orb orb-1"></div>
    <div class="ambient-orb orb-2"></div>

    <!-- Container Form -->
    <div class="login-card">
        <div class="brand-header">
            <h2>Sistem Parkir</h2>
            <p>Masuk ke akun Anda untuk mengakses sistem</p>
        </div>

        <!-- Form Action Mengarah ke /login (bukan /) -->
        <form action="/login" method="POST">
            @csrf

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-input" placeholder="Masukkan username" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-input" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-submit">Login</button>
        </form>
    </div>

</body>
</html>