<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'user_name'    => 'required|string|max:255|unique:tb_users,user_name',
            'password'     => 'required|string|min:4',
            'role'         => 'required|in:admin,petugas,owner',
        ]);

        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'user_name'    => $request->user_name,
            'password'     => Hash::make($request->password),
            'role'         => $request->role,
            'status_aktif' => '1',
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit($id)
{
    $user = User::findOrFail($id); // Mencari user berdasarkan ID
    
    return view('admin.user.edit', compact('user')); // Mengirim $user ke view
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'user_name'    => 'required|string|max:255|unique:tb_users,user_name,' . $id . ',id_user',
            'role'         => 'required|in:admin,petugas,owner',
        ]);

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'user_name'    => $request->user_name,
            'role'         => $request->role,
        ];

        // Jika password diisi, update password baru dengan Hash
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.user.index')->with('success', 'Data user berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus!');
    }
}