<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        $roles = Role::all();
        return view('master.users', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        if (!$user) {
            Alert::error('Gagal', 'Data Gagal Ditambahkan');
            return redirect()->route('users.index');
        }

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('users.index');
    }

    public function update(Request $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $user->syncRoles($request->role);

        if (!$user) {
            Alert::error('Gagal', 'Data Gagal Diubah');
            return redirect()->route('users.index');
        }

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        if (!$user) {
            Alert::error('Gagal', 'Data Gagal Dihapus');
            return redirect()->route('users.index');
        }

        Alert::success('Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('users.index');
    }
}
