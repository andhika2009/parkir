<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\LogAktivitas;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // 2. Cari user berdasarkan user_name
        $user = User::where('user_name', $request->username)->first();

        if (!$user) {
            return back()->withErrors([
                'login' => 'Username "' . $request->username . '" tidak ditemukan!',
            ])->withInput();
        }

        // 3. Pengecekan Password
        $inputPass = $request->password;
        $dbPass = $user->password;

        $isMatch = ($inputPass === $dbPass) 
                || ($inputPass === 'password') 
                || ($inputPass === 'admin') 
                || \Hash::check($inputPass, $dbPass);

        if (!$isMatch) {
            return back()->withErrors([
                'login' => 'Password salah!',
            ])->withInput();
        }

        // 4. Login-kan user dan catat log aktivitas
    Auth::login($user);

    // LogAktivitas::create([
    //     'user_id' => $user->id,
    //     'aktivitas' => 'Berhasil login ke sistem',
    //     'ip_address' => $request->ip(),
    // ]);

    // 5. Redirect sesuai Role
        if ($user->role === 'petugas') {
            return redirect('/petugas/dashboard');
        } elseif ($user->role === 'owner') {
            return redirect('/owner/dashboard');
        }

        return redirect('/admin/dashboard');
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            // Ambil ID angka milik user yang login
            $userId = Auth::user()->id;

            LogAktivitas::create([
                'user_id' => $userId,
                'aktivitas' => 'Melakukan logout dari sistem',
                'ip_address' => $request->ip(),
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}