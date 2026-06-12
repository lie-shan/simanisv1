<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        $totalUsers = $users->count();
        $totalAdmin = $users->where('role', 'admin')->count();
        $totalOperator = $users->where('role', 'operator')->count();
        $totalAktif = $users->where('status', 'aktif')->count();
        return view('admin.pengguna', compact(
            'users', 'totalUsers', 'totalAdmin', 'totalOperator', 'totalAktif'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'no_hp' => 'nullable|string|max:20',
            'role' => 'required|in:admin,operator,user',
            'status' => 'required|in:aktif,tidak-aktif',
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('admin.pengguna')
            ->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
            'password' => 'nullable|min:6',
            'no_hp' => 'nullable|string|max:20',
            'role' => 'required|in:admin,operator,user',
            'status' => 'required|in:aktif,tidak-aktif',
        ]);

        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.pengguna')
            ->with('success', 'Pengguna berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.pengguna')
                ->with('error', 'Tidak dapat menghapus akun sendiri');
        }

        $user->delete();

        return redirect()->route('admin.pengguna')
            ->with('success', 'Pengguna berhasil dihapus');
    }
}
