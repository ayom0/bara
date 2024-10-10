<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan halaman User Management
    public function index()
    {
        $users = User::all();
        return view('admin.usermanagement', compact('users'));
    }

    // Menambahkan user baru
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'phone' => 'required|string',
            'address' => 'required|string',
            'role' => 'required',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
            'phone_number' => $request->phone,
            'address' => $request->address,
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'User added successfully');
    }

    // Menampilkan form edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user); // Returning as JSON for the modal
    }

    // Mengupdate data user
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string',
            'address' => 'required|string',
            'role' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'address' => $request->address,
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'User updated successfully');
    }

    // Menghapus user
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with('success', 'User deleted successfully');
    }
}
